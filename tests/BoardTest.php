<?php

declare(strict_types=1);

namespace Kisoty\Tests;

use Exception;
use Kisoty\Board;
use Kisoty\Position;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    private Board $board;

    public function testGetStartPoint()
    {
        $this->makeBoard([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $startPoint = $this->board->getStartPoint();

        $this->assertEquals(1, $startPoint->getValue());
    }

    public function testGetPointByPosition()
    {
        $this->makeBoard([
            [1, 2, 3],
            [4, 5, 6]
        ]);

        $pointPosition = new Position(1,1);
        $point = $this->board->getPointByPosition($pointPosition);

        $this->assertEquals(5, $point->getValue());
    }

    public function testNon2DArrayCreation()
    {
        $this->expectException(Exception::class);

        new Board(
            [1, 2, 3],
            3
        );
    }

    /**
     * @param array[] $array
     * @throws Exception
     */
    public function makeBoard(array $array): void
    {
        $this->board = new Board($array);
    }

}
