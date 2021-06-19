<?php

namespace Src\Domain\ValueObject\Directions;

use Src\Domain\MarsRover;
use Src\Domain\ValueObject\Direction;
use Src\Domain\ValueObject\Position;

class North extends AbstractDirectionClass {

    public function turnLeft( MarsRover $rover )
    {
        $rover->setDirection(new Direction(Direction::WEST));
    }

    public function turnRight( MarsRover $rover ) 
    {
        $rover->setDirection(new Direction(Direction::EAST));
    }

    public function calculateNewPositionForward( Position $currentPosition ) : Position
    {
        $newX = $currentPosition->getX();
        $newY = $currentPosition->getY();
        ++$newY;
        return new Position($newX, $newY);
    }

}