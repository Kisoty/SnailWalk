<?php

declare(strict_types=1);

namespace Kisoty\Tests;

use Kisoty\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{

    public function testEquals()
    {
        $position1 = new Position(1, 1);
        $position2 = new Position(1, 1);

        $equals = $position1->equals($position2);

        $this->assertTrue($equals);
    }
}
