<?php

namespace Test\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Src\Domain\Exception\InvalidCoordenatePositionException;
use Src\Domain\ValueObject\Position;

class PositionTest extends TestCase {

    public function test_can_inicialize_position()
    {
        $position = new Position(10, 20);
        self::assertInstanceOf(Position::class, $position);
    }

    public function test_can_get_coordenates()
    {
        $x = 15;
        $y = 30;

        $position = new Position($x, $y);
        self::assertEquals($x, $position->getX());
        self::assertEquals($y, $position->getY());
    }

    
    public function test_should_exception_when_invalid_coordenates()
    {
        $x = -5;
        $y = 30;
        $this->expectException(InvalidCoordenatePositionException::class);
        new Position($x, $y);
    }
}