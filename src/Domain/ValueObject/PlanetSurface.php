<?php

namespace Src\Domain\ValueObject;

use InvalidArgumentException;

class PlanetSurface {

    /**
     * @var int
     */
    private $with;

    /**
     * @var int
     */
    private $height;


    public function __construct($with, $height)
    {
        $this->validate($with, $height);
        $this->with = $with;
        $this->height = $height;
    }


    private function validate( $with, $height ) : void
    {
        if ( $with < 0 ) {
            throw new InvalidArgumentException();
        }

        if ( $height < 0 ) {
            throw new InvalidArgumentException();
        }
    }


    public function with()
    {
        return $this->with;
    }

    public function height()
    {
        return $this->height;
    }

    /**
     * check if position has an obstacle
     * 
     * @param Position $position current position
     * @return bool
     */
    public function checkPointIsObstacle(Position $position) : bool
    {
        return ( $position->getX() > $this->with || $position->getY() > $this->height);
    }
}