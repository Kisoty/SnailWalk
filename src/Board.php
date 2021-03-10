<?php

namespace Kisoty;

use Exception;
use Kisoty\Direction\RightDirection;
use Kisoty\Direction\DirectionInterface;

class Board
{
    private UniquePointList $points;

    public function __construct(UniquePointList $points)
    {
        $this->points = $points;
    }

    /**
     * @throws Exception
     */
    public function getStartPoint(): Point
    {
        try {
            $startPoint = $this->getPointByPosition(new Position(0, 0));
        } catch (Exception $e) {
            throw new Exception('Start point not found.');
        }

        return $startPoint;
    }

    public function getStartDirection(): DirectionInterface
    {
        return new RightDirection();
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
