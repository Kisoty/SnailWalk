<?php

declare(strict_types=1);

namespace Kisoty;

use Exception;
use Kisoty\Direction\RightDirection;
use Kisoty\Direction\DirectionInterface;

class Board
{
    private UniquePointList $points;
    private DirectionInterface $startDirection;

    /**
     * @param array[] $array
     * @throws Exception
     */
    public function __construct(array $array)
    {
        $this->points = $this->makePointListFromArray($array);
        $this->startDirection = new RightDirection();
    }

    /**
     * @throws Exception
     */
    private function makePointListFromArray(array $array): UniquePointList
    {
        $height = count($array);

        $pointList = new UniquePointList();

        for ($i = 0; $i < $height; $i++) {
            $row = $array[$i];

            if (!is_array($row)) {
                throw new Exception('Given array is not 2-dimensional.');
            }

            $width = count($array[$i]);

            for ($j = 0; $j < $width; $j++) {
                $pointList->add(new Point(new Position($j, $i), $row[$j]));
            }
        }

        return $pointList;
    }

    /**
     * @throws Exception
     */
    public function getStartPoint(): Point
    {
        foreach ($this->points as $point) {
            return $point;
        }

        throw new Exception('Board is empty.');
    }

    public function getStartDirection(): DirectionInterface
    {
        return $this->startDirection;
    }

    /**
     * @throws Exception
     */
    public function getNextPointInDirection(Point $point, DirectionInterface $direction): Point
    {
        $pointPosition = $point->getPosition();

        $nextPosition = $direction->getNextPosition($pointPosition);

        return $this->getPointByPosition($nextPosition);
    }

    /**
     * @throws Exception
     */
    private function getPointByPosition(Position $position): Point
    {
        foreach ($this->points as $point) {
            if ($position->equals($point->getPosition())) {
                return $point;
            }
        }

        throw new Exception('Point with given position doesn\'t exist.');
    }
}
