<?php

namespace Kisoty\Tests;

use Kisoty\Board;
use Kisoty\UniquePointList;

class BoardTest extends \PHPUnit\Framework\TestCase
{
    private Board $board;

    public function testGetStartPoint()
    {
        $this->makeBoardFrom2DMatrix([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $startPoint = $this->board->getStartPoint();

        $this->assertEquals(1, $startPoint->getValue());
    }

    public function makeBoardFrom2DMatrix(array $matrix): void
    {
        $pointList = UniquePointList::from2DMatrix($matrix);

        $this->board = new Board($pointList);
    }

}
