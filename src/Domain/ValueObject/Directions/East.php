<?php

namespace Src\Domain\ValueObject\Directions;

use Src\Domain\MarsRover;
use Src\Domain\ValueObject\Direction;
use Src\Domain\ValueObject\Position;

class East extends AbstractDirectionClass {


    public function turnLeft( MarsRover $rover )
    {
        $rover->setDirection(new Direction(Direction::NORTH));
    }

    public function turnRight( MarsRover $rover ) 
    {
        $rover->setDirection(new Direction(Direction::SOUTH));
    }

    public function calculateNewPositionForward( Position $currentPosition ) : Position
    {
        $newX = $currentPosition->getX();
        $newY = $currentPosition->getY();
        ++$newX;
        return new Position($newX, $newY);
    }

}