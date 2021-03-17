<?php

declare(strict_types=1);

namespace Kisoty\Tests\BoardWalkers;

use Kisoty\Board\Board;
use Kisoty\BoardWalkers\SnailWalker;
use Kisoty\Directions\RightDirection;
use PHPUnit\Framework\TestCase;

class SnailWalkerTest extends TestCase
{

    public function testWalkBoardWithStep1()
    {
        $board = new Board([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ]);
        $walker = new SnailWalker($board, new RightDirection(), 1);

        $path = $walker->walkBoard();

        $this->assertEquals([1, 2, 3, 6, 9, 8, 7, 4, 5], $path);
    }

    public function testWalkBoardWithStep2()
    {
        $board = new Board([
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ]);
        $walker = new SnailWalker($board, new RightDirection(), 2);

        $path = $walker->walkBoard();

        $this->assertEquals([1, 3, 9, 7], $path);
    }
}
