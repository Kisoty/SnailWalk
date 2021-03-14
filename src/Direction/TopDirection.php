<?php

declare(strict_types=1);

namespace Kisoty\Direction;

use Kisoty\Position;

class TopDirection implements DirectionInterface
{
    public function getNextPosition(Position $position, int $stepSize): Position
    {
        // Y-axis is downward
        return new Position($position->getX(), $position->getY() - $stepSize);
    }

    public function turnRight(): DirectionInterface
    {
        return new RightDirection();
    }
}
