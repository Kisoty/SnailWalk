<?php

declare(strict_types=1);

namespace Kisoty;

class Position
{
    private int $x;
    private int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function equals(Position $position): bool
    {
        return ($position->getX() === $this->x) && ($position->getY() === $this->y);
    }
}
