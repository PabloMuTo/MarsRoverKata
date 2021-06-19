<?php

namespace Src\Application;

class MoveRoverRequest {

    private $position_x;
    private $position_y;
    private $direction;
    private $commands;

    public function __construct( $position_x, $position_y, $direction, $commands)
    {
        $this->position_x = $position_x;
        $this->position_y = $position_y;
        $this->direction = $direction;
        $this->commands  = $commands;
    }

    public function positionX()
    {
        return $this->position_x;
    }

    public function positionY()
    {
        return $this->position_y;
    }

    public function direction()
    {
        return $this->direction;
    }

    public function commands()
    {
        return $this->commands;
    }
}
