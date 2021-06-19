<?php

namespace Test\Infraestructure;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Src\Infraestructure\MoveRoverCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Test\IntegrationTestCase;

class MoveRoverCommandTest extends TestCase
{
    private $application;


    protected function setUp() :void
    {
        parent::setUp();
        $this->application = new Application();
        $this->application->add(new MoveRoverCommand());
    }

    /**
     * @dataProvider ordersProvider
     */
    public function testCoffeeMachineReturnsTheExpectedOutput(
         $positionX,
         $positionY,
         $direction,
         $commands,
         $expectedOutput
    ): void {
        $command = $this->application->find('app:rover');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'position-x' => $positionX,
            'position-y' => $positionY,
            'direction' => $direction,
            'commands' => $commands
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertSame($expectedOutput, $output);
    }

    public function ordersProvider(): array
    {
        return [ 
            [
                '10', '10', 'W', 'FFF', 'Rover movement completed. Rover position (x: 7 y: 10). Rover direction: W' . PHP_EOL
            ],
            [
                '10', '10', 'S', 'RRLL', 'Rover movement completed. Rover position (x: 10 y: 10). Rover direction: S' . PHP_EOL
            ],
            [
                '190', '190', 'E', 'RFFF', 'Rover movement completed. Rover position (x: 190 y: 187). Rover direction: S' . PHP_EOL
            ],
            [
                '190', '190', 'E', '', 'Rover movement completed. Rover position (x: 190 y: 190). Rover direction: E' . PHP_EOL
            ],
            [
                '195', '190', 'E', 'FFFFFFF', 'Obstacle detection at point (x: 201 y: 190). Rover orientation: E' . PHP_EOL
            ],
            [
                '190', '195', 'N', 'FFFFFFF', 'Obstacle detection at point (x: 190 y: 201). Rover orientation: N' . PHP_EOL
            ],
           
        ];
    }
}
