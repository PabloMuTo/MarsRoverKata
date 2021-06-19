<?php

namespace Src\Application;

use Src\Domain\MarsRover;
use Src\Domain\ValueObject\Direction;
use Src\Domain\ValueObject\PlanetSurface;
use Src\Domain\ValueObject\Position;

class MoveRoverUseCase {



    public function execute( MoveRoverRequest $request ) : MarsRover
    {
        $rover = new MarsRover(
            new Position($request->positionX(), $request->positionY()),
            new Direction($request->direction()),
            new PlanetSurface(200, 200)
        );

        $rover->processCommands($request->commands());
        return $rover;
    }
}