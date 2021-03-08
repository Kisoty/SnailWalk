<?php

namespace Kisoty;

use Exception;
use Kisoty\Direction\RightDirection;
use Kisoty\Direction\DirectionInterface;

class Board
{
    private UniquePointList $points;
    private WalkingObject $object;

    public function __construct(UniquePointList $points)
    {
        $this->points = $points;
    }

    public function setObject(WalkingObject $object): void
    {
        $this->object = $object;
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
    public function getNextPointToObj(): Point
    {
        if (!isset($this->object)) {
            throw new Exception('Object is not set.');
        }

        $objPosition = $this->object->getPosition();
        $objDirection = $this->object->getDirection();

        $nextPosition = $objDirection->getNextPosition($objPosition);

        return $this->points->getByPosition($nextPosition);
    }
}