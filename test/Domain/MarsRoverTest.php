<?php

namespace Test\Domain;

use Src\Domain\MarsRover;
use PHPUnit\Framework\TestCase;
use Src\Domain\ValueObject\Direction;
use Src\Domain\ValueObject\PlanetSurface;
use Src\Domain\ValueObject\Position;

class MarsRoverTest extends TestCase {

    /**
	 * @var Surface
	 */
	private static $surface;
	/**
	 * @var Rover
	 */
	private static $rover;
	/**
	 * @var Direction
	 */
	private static $starterDirection;
	/**
	 * @var Point
	 */
	private static $starterPosition;


    public static function setUpBeforeClass() : void
	{
		self::$surface          = new PlanetSurface(200, 200);
		self::$starterPosition  = new Position(1, 2);
		self::$starterDirection = new Direction('N');
		self::$rover            = new MarsRover(self::$starterPosition, self::$starterDirection, self::$surface);
	}


    /**
     * @author Pablo Muñoz 16/05/2025
     */
    public function test_can_create_mars_rover_class()
    {
        self::assertInstanceOf(MarsRover::class, self::$rover);
    }


    public function test_should_have_planet_surface() 
    {
        self::assertEquals(self::$rover->surface(), self::$surface);
    }


    public function test_should_have_start_position()
    {
        self::assertEquals(self::$rover->position(), self::$starterPosition);
    }


    public function test_should_have_start_direction()
    {
        self::assertEquals(self::$rover->direction(), self::$starterDirection);
    }


    public function test_should_change_direction()
    {
        $newDirection = new Direction("S");
        self::$rover->setDirection($newDirection);
        self::assertEquals(self::$rover->direction(), $newDirection);
    }


    public function test_should_change_position()
    {
        $newPosition = new Position(50,24);
        self::$rover->setPosition($newPosition);
        self::assertEquals(self::$rover->position(), $newPosition);
    }

    public function test_should_move_left()
    {
        self::$rover->turnLeft();
        self::assertEquals(self::$rover->direction(), new Direction("E"));
    }


    public function test_should_move_right()
    {
        self::$rover->turnRight();
        self::assertEquals(self::$rover->direction(), new Direction("S"));
    }


    public function test_shoud_move_forward()
    {
        self::$rover->moveForward();
        self::assertEquals(self::$rover->position(), new Position(50, 23));
    }

}