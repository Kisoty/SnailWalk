<?php

declare(strict_types=1);

namespace Kisoty\Directions;

use Kisoty\Position;

interface DirectionInterface
{
    public function getNextPosition(Position $position, int $stepSize): Position;

    public function turnRight(): DirectionInterface;
}
