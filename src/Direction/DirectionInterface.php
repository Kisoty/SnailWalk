<?php

namespace Kisoty\Direction;

use Kisoty\Position;

interface DirectionInterface
{
    public function getNextPosition(Position $position): Position;

    public function turnRight(): DirectionInterface;
}