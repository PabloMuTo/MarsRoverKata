<?php

namespace Src\Domain\ValueObject;

use Src\Domain\Exception\InvalidCoordenatePositionException;

class Position
{
    /**
     * X position
     * @var int
     */
    private $x;

    /**
     * Y position
     * @var int
     */
    private $y;

    public function __construct( int $x, int $y )
    {
        $this->validate($x, $y);
        $this->x = $x;
        $this->y = $y;
    }

    private function validate($x, $y)
    {
        if ( $x < 0 ) {
            throw new InvalidCoordenatePositionException("invalid X coordenate {$x}");
        }

        if ( $y < 0 ) {
            throw new InvalidCoordenatePositionException("invalid Y coordenate {$y}");
        }
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }
}