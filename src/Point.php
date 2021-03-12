<?php

namespace Kisoty;

class Point
{
    private Position $position;
    private int $value;
    private bool $passed;

    public function __construct(Position $position, int $value)
    {
        $this->position = $position;
        $this->value = $value;
        $this->passed = false;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isPassed(): bool
    {
        return $this->passed;
    }

    public function pass()
    {
        $this->passed = true;
    }
}
