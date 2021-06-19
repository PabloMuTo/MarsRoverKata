<?php

namespace Test\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Src\Domain\Exception\IncorrectDirectionException;
use Src\Domain\ValueObject\Direction;

class DirectionTest extends TestCase
{

    public function test_can_create_direction_object()
    {
        $Direction = new Direction("W");
        self::assertInstanceOf(Direction::class, $Direction);
    }

    public function test_should_exception_when_invalid_direction()
    {
        $this->expectException(IncorrectDirectionException::class);
        new Direction("P");
    }
} 