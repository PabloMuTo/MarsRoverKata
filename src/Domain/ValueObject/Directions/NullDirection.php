<?php

namespace Src\Domain\ValueObject\Directions;

use Src\Domain\MarsRover;
use Src\Domain\ValueObject\Direction;
use Src\Domain\ValueObject\Position;

class NullDirection extends AbstractDirectionClass {


    public function turnLeft( MarsRover $rover )
    {
       ;
    }

    public function turnRight( MarsRover $rover ) 
    {
        ;
    }

    public function calculateNewPositionForward( Position $currentPosition ) : Position
    {
       return $currentPosition;
    }

}