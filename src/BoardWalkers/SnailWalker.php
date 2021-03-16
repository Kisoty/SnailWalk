<?php

declare(strict_types=1);

namespace Kisoty\BoardWalkers;

use Kisoty\Board\Board;
use Kisoty\Board\PointNotFoundException;
use Kisoty\Directions\DirectionInterface;
use Kisoty\Point;
use Kisoty\Position;

class SnailWalker extends AbstractBoardWalker
{
    private DirectionInterface $direction;
    private array $path;
    private int $stuckCounter = 0;
    private int $stepSize;

    /**
     * @throws PointNotFoundException
     */
    public function __construct(Board $board, DirectionInterface $direction, int $stepSize)
    {
        $this->board = $board;
        $this->direction = $direction;
        $this->stepSize = $stepSize;
        $this->path = [];
        $this->moveToPoint($this->board->getStartPoint());
    }

    public function walkBoard(): array
    {
        while ($this->canContinueWalking()) {
            try {
                $this->step();
                $this->unstuck();
            } catch (PointNotFoundException | PointIsNotAllowedException $e) {
                $this->stuck();
                $this->turnRight();
            }
        }

        return $this->path;
    }

    private function canContinueWalking(): bool
    {
        return $this->stuckCounter < 2;
    }

    /**
     * @throws PointNotFoundException|PointIsNotAllowedException
     */
    private function step(): void
    {
        $nextPoint = $this->getNextPoint();

        if ($this->canMoveToPoint($nextPoint)) {
            $this->moveToPoint($nextPoint);
        } else {
            throw new PointIsNotAllowedException('Can\'t move to this point.');
        }
    }

    /**
     * @throws PointNotFoundException
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
