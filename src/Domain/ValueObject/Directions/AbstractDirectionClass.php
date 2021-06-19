<?php

namespace Src\Domain\ValueObject\Directions;

use Src\Domain\Exception\ObstacleFoundException;
use Src\Domain\MarsRover;
use Src\Domain\ValueObject\Position;

abstract class AbstractDirectionClass {

    public abstract function turnLeft( MarsRover $rover );

    public abstract function turnRight( MarsRover $rover );

    public abstract function calculateNewPositionForward( Position $currentPosition ) : Position;

    public function moveForward( MarsRover $rover )
    {
        $currentPosition = $rover->position();
        $newPosition = $this->calculateNewPositionForward( $currentPosition );

        if ( $rover->surface()->checkPointIsObstacle($newPosition) ) {
            $roverDirection = $rover->direction()->getDirection();
            throw new ObstacleFoundException('Obstacle detection at point (x: ' . $newPosition->getX() . ' y: ' . $newPosition->getY() . '). Rover orientation: '.$roverDirection);
        }

        $rover->setPosition($newPosition);
    }

}