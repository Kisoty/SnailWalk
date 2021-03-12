<?php

namespace Kisoty\Tests;

use Exception;
use Kisoty\Board;
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

    /**
     * @param array[] $array
     * @throws Exception
     */
    public function makeBoard(array $array): void
    {
        $this->board = new Board($array);
    }

}
