<?php

declare(strict_types=1);

namespace Kisoty\Tests\Board;

use Kisoty\Board\Board;
use Kisoty\Board\BoardCreationException;
use Kisoty\Position;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testGetStartPoint()
    {
        $board = new Board([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $startPoint = $board->getStartPoint();

        $this->assertEquals(1, $startPoint->getValue());
    }

    public function testGetStartPointPosition()
    {
        $board = new Board([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $startPoint = $board->getStartPoint();
        $startPosition = $startPoint->getPosition();
        $expectedPosition = new Position(0, 0);

        $this->assertTrue($startPosition->equals($expectedPosition));
    }

    public function testGetPointByPosition()
    {
        $board = new Board([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $pointPosition = new Position(1, 1);
        $point = $board->getPointByPosition($pointPosition);

        $this->assertEquals(5, $point->getValue());
    }


    public function testBoardCreationWithEmptyArrayRow()
    {
        $this->expectException(BoardCreationException::class);

        new Board([
            [1, 2, 3],
            []
        ]);
    }

    public function testBoardCreationWithIntRow()
    {
        $this->expectException(BoardCreationException::class);

        new Board([
            [1, 2, 3],
            3
        ]);
    }

    public function testBoardCreationWithStringRow()
    {
        $this->expectException(BoardCreationException::class);

        new Board([
            [1, 2, 3],
            '1'
        ]);
    }
}
