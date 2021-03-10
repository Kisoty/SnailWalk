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

    public function getStartPoint(): Point
    {
        try {
            return $this->points->getByPosition(new Position(0, 0));
        } catch (Exception $e) {
            throw new Exception('Start point not found.');
        }
    }

    public function getStartDirection(): DirectionInterface
    {
        return new RightDirection;
    }

    /**
     * @throws Exception
     */
    public function getNextPointInDirection(Point $point, DirectionInterface $direction): Point
    {
        $pointPosition = $point->getPosition();

        $nextPosition = $direction->getNextPosition($pointPosition);

        return $this->points->getByPosition($nextPosition);
    }
}
