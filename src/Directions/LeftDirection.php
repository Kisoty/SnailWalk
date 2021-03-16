<?php

declare(strict_types=1);

namespace Kisoty\Directions;

use Kisoty\Position;

class LeftDirection implements DirectionInterface
{
    public function getNextPosition(Position $position, int $stepSize): Position
    {
        return new Position($position->getX() - $stepSize, $position->getY());
    }

    public function turnRight(): DirectionInterface
    {
        return new TopDirection();
    }
}
