<?php

namespace Kisoty\Direction;

use Kisoty\Position;

class TopDirection implements DirectionInterface
{
    public function getNextPosition(Position $position): Position
    {
        // Y-axis is downward
        return new Position($position->getX(), $position->getY() - 1);
    }

    public function turnRight(): DirectionInterface
    {
        return new RightDirection;
    }
}