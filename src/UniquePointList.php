<?php

namespace Kisoty;

use Traversable;

class UniquePointList implements \IteratorAggregate
{
    /** @var Point[] $points */
    private array $points;

    public function __construct()
    {
        $this->points = [];
    }

    public function add(Point $point): void
    {
        if (!$this->contains($point)) {
            $this->points[] = $point;
        }
    }

    public function contains(Point $point): bool
    {
        return in_array($point, $this->points);
    }

    public function remove(Point $point): void
    {
        $key = array_search($point, $this->points);

        if ($key !== false) {
            unset($this->points[$key]);
        }
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->points);
    }
}
