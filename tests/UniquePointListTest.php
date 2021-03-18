<?php

declare(strict_types=1);


namespace Kisoty\Tests;

use Kisoty\Point;
use Kisoty\Position;
use Kisoty\UniquePointList;
use PHPUnit\Framework\TestCase;

class UniquePointListTest extends TestCase
{
    public function testAdd()
    {
        $list = new UniquePointList();
        $point1 = $this->createStub(Point::class);
        $point1
            ->method('getPosition')
            ->willReturn(new Position(1, 1));
        $point2 = $this->createStub(Point::class);
        $point2
            ->method('getPosition')
            ->willReturn(new Position(1, 1));

        $list
            ->add($point1)
            ->add($point2);
        $pointCount = $this->countList($list);

        $this->assertEquals(1, $pointCount);
    }

    public function testContains()
    {
        $list = new UniquePointList();
        $point1 = $this->createStub(Point::class);
        $point1
            ->method('getPosition')
            ->willReturn(new Position(1, 1));
        $list->add($point1);
        $point2 = $this->createStub(Point::class);
        $point2
            ->method('getPosition')
            ->willReturn(new Position(1, 1));

        $listContains = $list->contains($point2);

        $this->assertTrue($listContains);
    }

    public function testRemoveExistedPoint()
    {
        $list = new UniquePointList();
        $point1 = $this->createStub(Point::class);
        $point1->method('getPosition')
            ->willReturn(new Position(1, 1));

        $list->add($point1);

        $list->remove($point1);

        $this->assertEquals(0, $this->countList($list));
    }

    public function testRemoveAbsentPoint()
    {
        $list = new UniquePointList();
        $point1 = $this->createStub(Point::class);
        $point1->method('getPosition')
            ->willReturn(new Position(1, 1));
        $point1->method('getValue')
            ->willReturn(1);
        $point2 = $this->createStub(Point::class);
        $point2->method('getPosition')
            ->willReturn(new Position(1, 1));
        $point2->method('getValue')
            ->willReturn(2);
        $point3 = $this->createStub(Point::class);
        $point3->method('getPosition')
            ->willReturn(new Position(2, 1));
        $point3->method('getValue')
            ->willReturn(1);
        $list->add($point1);

        $list->remove($point2);
        $list->remove($point3);

        $this->assertEquals(1, $this->countList($list));
    }

    private function countList(UniquePointList $list): int
    {
        $pointCount = 0;

        foreach ($list as $item) {
            $pointCount++;
        }

        return $pointCount;
    }
}
