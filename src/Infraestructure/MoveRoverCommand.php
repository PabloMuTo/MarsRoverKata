<?php

namespace Src\Infraestructure;

use Src\Application\MoveRoverRequest;
use Src\Application\MoveRoverUseCase;
use Src\Domain\Exception\IncorrectDirectionException;
use Src\Domain\Exception\InvalidCoordenatePositionException;
use Src\Domain\Exception\ObstacleFoundException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class MoveRoverCommand extends Command
{
    protected static $defaultName = 'app:rover';


    protected function configure()
    {
        
        $this->addArgument(
            'position-x',
            InputArgument::REQUIRED,
            'Rover Starter Position X'
        );

        $this->addArgument(
            'position-y',
            InputArgument::REQUIRED,
            'Rover Starter Position Y'
        );

        $this->addArgument(
            'direction',
            InputArgument::REQUIRED,
            'Rover starter Orientation'
        );

        $this->addArgument(
            'commands',
            InputArgument::REQUIRED,
            'Movements commands'
        );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $x = (int)$input->getArgument('position-x');
        $y = (int)$input->getArgument('position-y');
        $direction   = $input->getArgument('direction');
        $commands    = $input->getArgument("commands");


        try {
            $UseCase = new MoveRoverUseCase();
            $rover = $UseCase->execute( new MoveRoverRequest($x, $y, $direction, $commands) );

            $output->writeln('Rover movement completed. Rover position (x: '.$rover->position()->getX().' y: '.$rover->position()->getY().'). Rover direction: '.$rover->direction()->getDirection());
        }
        catch ( IncorrectDirectionException $e ) {
            $output->writeln($e->getMessage());
        }
        catch ( InvalidCoordenatePositionException $e ) {
            $output->writeln($e->getMessage());
        }
        catch ( ObstacleFoundException $e ) {
            $output->writeln($e->getMessage());
        }

        
    }
}
