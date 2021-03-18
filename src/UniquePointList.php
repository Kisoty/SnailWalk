<?php

declare(strict_types=1);

namespace Kisoty;

use Traversable;

final class UniquePointList implements \IteratorAggregate
{
    /** @var Point[] $points */
    private array $points;

    public function __construct()
    {
        $this->points = [];
    }

    public function add(Point $point): self
    {
        if (!$this->contains($point)) {
            $this->points[] = $point;
        }

        return $this;
    }

    public function contains(Point $point): bool
    {
        return in_array($point, $this->points);
    }

    public function remove(Point $point): self
    {
        $key = array_search($point, $this->points);

        if ($key !== false) {
            unset($this->points[$key]);
        }

        return $this;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->points);
    }
}
