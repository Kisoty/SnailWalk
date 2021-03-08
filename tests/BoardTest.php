<?php

namespace Kisoty\Tests;

use Kisoty\Board;
use Kisoty\Point;
use Kisoty\UniquePointList;

class BoardTest extends \PHPUnit\Framework\TestCase
{
    public function testStartPoint()
    {
        $pointList = UniquePointList::fromMatrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $board = new Board($pointList);

        $startPoint = $board->getStartPoint();

        $this->assertInstanceOf(Point::class, $startPoint);
        $this->assertEquals(1, $startPoint->getValue());
    }

}