<?php

namespace Src\Domain\ValueObject;

use Exception;
use Src\Domain\Exception\IncorrectDirectionException;
use Src\Domain\MarsRover;
use Src\Domain\ValueObject\Directions\East;
use Src\Domain\ValueObject\Directions\North;
use Src\Domain\ValueObject\Directions\NullDirection;
use Src\Domain\ValueObject\Directions\South;
use Src\Domain\ValueObject\Directions\West;

class Direction
{
    const NORTH = 'N';
    const EAST  = 'E';
    const SOUTH = 'S';
    const WEST  = 'W';

    /**
     * @var array
     */
    private $directionClasses;

    /**
     * @var string
     */
    private $direction;

    private $directionCommand;

    public function __construct( string $direction)
    {
        $this->validate($direction);
        $this->setDirectionClasses();
        $this->changeDirection($direction);
    }

    private function validate($direction) : void
    {
        if ( !in_array($direction, $this->getAllowedDirection())) {
            throw new IncorrectDirectionException("incorrect direction {$direction}");
        }
    }

    private function setDirectionClasses() : void
    {
        $this->directionClasses = array(
            self::NORTH => new North(),
            self::WEST => new West(),
            self::SOUTH => new South(),
            self::EAST => new East()
        );
    }

    public function getAllowedDirection() : array
    {
        return [
            self::NORTH, self::EAST, self::SOUTH, self::WEST
        ];
    }

    public function changeDirection( $newDirection )
    {
        $this->direction        = $newDirection;      
        if ( !isset($this->directionClasses[$newDirection]) ) {
            $this->directionCommand = new NullDirection();
        }
        else {
            $this->directionCommand = $this->directionClasses[$newDirection];
        }
    }

        
    /**
     * @return string
     */
    public function getDirection() : string
    {
        return $this->direction;
    }


    public function turnLeft(MarsRover $rover)
    {
        $newDirection = $this->directionCommand->turnLeft($rover);
        $this->changeDirection($newDirection);
    }

    public function turnRight(MarsRover $rover)
    {
        $newDirection = $this->directionCommand->turnRight($rover);
        $this->changeDirection($newDirection);
    }

    public function moveForward(MarsRover $rover)
    {
        $this->directionCommand->moveForward($rover);
    }
} 