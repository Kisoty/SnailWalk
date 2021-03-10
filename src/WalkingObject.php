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
        $this->moveToPoint($this->board->getStartPoint());
    }

    public function walkBoard(): array
    {
        while ($this->stuck_counter < 2) {
            try {
                $this->move();
            } catch (Exception $e) {
                $this->stuck();
                $this->turnRight();
            }
        }

        return $this->path;
    }

    /**
     * @throws Exception
     */
    private function move(): void
    {
        $nextPoint = $this->getNextPoint();

        if ($this->canMoveToPoint($nextPoint)) {
            $this->moveToPoint($nextPoint);
        } else {
            throw new Exception('Can\'t move to this point.');
        }
    }

    private function getNextPoint(): Point
    {
        return $this->board->getNextPointInDirection($this->point, $this->direction);
    }

    private function canMoveToPoint(Point $point): bool
    {
        return $point->notPassed();
    }

    private function moveToPoint(Point $point): void
    {
        $this->unstuck();

        $this->point = $point;
        $point->pass();

        $this->path[] = $this->point->getValue();
    }

    private function stuck(): void
    {
        $this->stuck_counter++;
    }

    private function unstuck(): void
    {
        $this->stuck_counter = 0;
    }

    private function turnRight(): void
    {
        $this->direction = $this->direction->turnRight();
    }
}
