<?php

namespace Src\Domain;

use Src\Domain\ValueObject\Direction;
use Src\Domain\ValueObject\PlanetSurface;
use Src\Domain\ValueObject\Position;

class MarsRover {

    private $position;
    private $direction;
    private $surface;
    private $commandsClasses;

    public function __construct(Position $startPosition, Direction $startDirection, PlanetSurface $surface)
	{
        $this->setPosition($startPosition);
        $this->setDirection($startDirection);
        $this->setSurface($surface);
        $this->initCommands();
	}


    private function initCommands()
    {
        $this->commandsClasses = [
            'L' => 'turnLeft',
            'R' => 'turnRight',
            'F' => 'moveForward'
        ];
    }

    // -----------------------
    // ---------- INSTRUCTIONS AND COMMANDS
    // -----------------------

    public function processCommands( $commands )
    {
        $movements = array();
        for ($i = 0; $i < strlen($commands); $i++) {
            $movementCommand = $this->parseCommand(substr($commands, $i, 1));
            if ( $movementCommand ) {
                $movements[] = $movementCommand;
            }
        }

        foreach ( $movements as $movement ) {
            $this->{$movement}();
        }
    }


    private function parseCommand( $command )
    {
        return $this->commandsClasses[$command];
    }


    // -----------------------
    // ---------- SETTERS AND GETTERS
    // -----------------------

    public function setPosition(Position $position)
    {
        $this->position = $position;
    }

    /**
     * Get current rover position
     * @return Position
     */
    public function position() : Position
    {
        return $this->position;
    }

    public function setDirection( Direction $direction )
    {
        $this->direction = $direction;
    }

    /**
     * Get current rover direction
     * @return Direction
     */
    public function direction() : Direction
    {
        return $this->direction;
    }


    public function setSurface( PlanetSurface $surface)
    {
        $this->surface = $surface;
    }

    public function surface()
    {
        return $this->surface;
    }



    // -----------------------
    // ---------- MOVEMENT
    // -----------------------


    public function moveForward() : void
    {
        $this->direction()->moveForward($this);
    }

    /**
     * Turn rover to left
     */
    public function turnLeft() : void
    {
        $this->direction()->turnLeft($this);
    }

    /**
     * Turn rover to right
     */
    public function turnRight() : void
    {
        $this->direction()->turnRight($this);
    }

}