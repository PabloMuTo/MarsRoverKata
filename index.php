#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Src\Infraestructure\MoveRoverCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new MoveRoverCommand());
$application->run();
