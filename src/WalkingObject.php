<?php

namespace Kisoty;

use Exception;
use Kisoty\Direction\DirectionInterface;

class WalkingObject
{
    private Point $point;
    private DirectionInterface $direction;
    private Board $board;
    private array $path;
    private int $stuck_counter;

    /**
     * @throws Exception
     */
    public function __construct(Board $board)
    {
        $this->board = $board;
        $this->direction = $this->board->getStartDirection();
        $this->point = $this->board->getStartPoint();
        $this->point->pass();
        $this->path = [$this->point->getValue()];
        $this->stuck_counter = 0;
    }

    public function getPosition(): Position
    {
        return $this->point->getPosition();
    }

    public function getDirection(): DirectionInterface
    {
        return $this->direction;
    }

    public function walkBoard(): array
    {
        while ($this->stuck_counter < 2) {
            $this->move();
        }

        return $this->path;
    }

    private function move(): void
    {
        if ($this->canMoveForward()) {
            $this->moveForward();
        } else {
            $this->stuck_counter++;
            $this->direction = $this->direction->turnRight();
        }
    }

    private function canMoveForward(): bool
    {
        try {
            $nextPoint = $this->board->getNextPointToObj();
        } catch (Exception $e) {
            return false;
        }

        return $nextPoint->notPassed();
    }

    private function moveForward(): void
    {
        $this->unstuck();

        $this->point = $this->board->getNextPointToObj();
        $this->point->pass();

        $this->path[] = $this->point->getValue();
    }

    private function unstuck(): void
    {
        $this->stuck_counter = 0;
    }
}