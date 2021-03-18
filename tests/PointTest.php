<?php

declare(strict_types=1);

namespace Kisoty\Tests;

use Kisoty\Point;
use Kisoty\Position;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{

    public function testPass()
    {
        $point = new Point(new Position(1, 1), 1);

        $point->pass();

        $this->assertTrue($point->isPassed());
    }
}
