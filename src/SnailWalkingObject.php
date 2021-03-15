<?php

declare(strict_types=1);

namespace Kisoty;

use Exception;
use Kisoty\Direction\DirectionInterface;

class SnailWalkingObject
{
    private Point $point;
    private DirectionInterface $direction;
    private Board $board;
    private array $path;
    private int $stuckCounter;
    private int $stepSize = 1;

    /**
     * @throws Exception
     */
    public function __construct(Board $board, DirectionInterface $direction)
    {
        $this->board = $board;
        $this->direction = $direction;
        $this->moveToPoint($this->board->getStartPoint());
    }

    public function walkBoard(): array
    {
        while ($this->stuckCounter < 2) {
            try {
                $this->step();
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
    private function step(): void
    {
        $nextPoint = $this->getNextPoint();

        if ($this->canMoveToPoint($nextPoint)) {
            $this->moveToPoint($nextPoint);
        } else {
            throw new Exception('Can\'t move to this point.');
        }
    }

    /**
     * @throws Exception
     */
    private function getNextPoint(): Point
    {
        $newPosition = $this->getNextPointPosition();

        return $this->board->getPointByPosition($newPosition);
    }

    private function getNextPointPosition(): Position
    {
        $currentPosition = $this->point->getPosition();

        return $this->direction->getNextPosition($currentPosition, $this->stepSize);
    }

    private function canMoveToPoint(Point $point): bool
    {
        return !$point->isPassed();
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
        $this->stuckCounter++;
    }

    private function unstuck(): void
    {
        $this->stuckCounter = 0;
    }

    private function turnRight(): void
    {
        $this->direction = $this->direction->turnRight();
    }
}
