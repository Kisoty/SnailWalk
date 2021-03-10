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

    public static function from2DMatrix(array $matrix): UniquePointList
    {
        $height = count($matrix);
        $width = count($matrix[0]);

        $pointList = new UniquePointList();

        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $pointList->add(new Point(new Position($j, $i), $matrix[$i][$j]));
            }
        }

        return $pointList;
    }

    public function add(Point $point): void
    {
        if (!$this->contains($point)) {
            $this->points[] = $point;
        }
    }

    public function contains(Point $point): bool
    {
        return in_array($point, $this->points, true);
    }

    public function remove(Point $point): void
    {
        $key = array_search($point, $this->points, true);

        if ($key !== false) {
            unset($this->points[$key]);
        }
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->points);
    }
}
