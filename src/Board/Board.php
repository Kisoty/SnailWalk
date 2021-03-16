<?php

declare(strict_types=1);

namespace Kisoty\Board;

use Kisoty\Point;
use Kisoty\Position;
use Kisoty\UniquePointList;

class Board
{
    private UniquePointList $points;

    /**
     * @psalm-param array<array<int>>
     * @param array[] $array
     * @throws BoardCreationException
     */
    public function __construct(array $array)
    {
        $this->points = $this->makePointListFromArray($array);
    }

    /**
     * @psalm-param array<array<int>>
     * @param array[] $array
     * @throws BoardCreationException
     */
    private function makePointListFromArray(array $array): UniquePointList
    {
        $height = count($array);

        $pointList = new UniquePointList();

        for ($i = 0; $i < $height; $i++) {
            $row = $array[$i];

            if (!is_array($row) || empty($row)) {
                throw new BoardCreationException('Given array is not valid 2-dimensional.');
            }

            $width = count($array[$i]);

            for ($j = 0; $j < $width; $j++) {
                $item = $row[$j];

                if (!is_int($item)) {
                    throw new BoardCreationException('Given array is not valid 2-dimensional.');
                }

                $pointList->add(new Point(new Position($j, $i), $row[$j]));
            }
        }

        return $pointList;
    }

    /**
     * @throws PointNotFoundException
     */
    public function getStartPoint(): Point
    {
        foreach ($this->points as $point) {
            return $point;
        }

        throw new PointNotFoundException('Board is empty.');
    }

    /**
     * @throws PointNotFoundException
     */
    public function getPointByPosition(Position $position): Point
    {
        foreach ($this->points as $point) {
            if ($position->equals($point->getPosition())) {
                return $point;
            }
        }

        throw new PointNotFoundException('Point with given position doesn\'t exist.');
    }
}
