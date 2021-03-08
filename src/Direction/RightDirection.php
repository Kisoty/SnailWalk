<?php

namespace Kisoty\Direction;

use Kisoty\Position;

class RightDirection implements DirectionInterface
{
    public function getNextPosition(Position $position): Position
    {
        return new Position($position->getX() + 1, $position->getY());
    }

    public function turnRight(): DirectionInterface
    {
        return new BottomDirection;
    }
}