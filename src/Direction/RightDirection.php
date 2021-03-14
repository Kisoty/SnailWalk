<?php

declare(strict_types=1);

namespace Kisoty\Direction;

use Kisoty\Position;

class RightDirection implements DirectionInterface
{
    public function getNextPosition(Position $position, int $stepSize): Position
    {
        return new Position($position->getX() + $stepSize, $position->getY());
    }

    public function turnRight(): DirectionInterface
    {
        return new BottomDirection();
    }
}
