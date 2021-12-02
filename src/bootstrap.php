<?php
declare(strict_types=1);

require_once "vendor/autoload.php";

use Tracy\Debugger;

Debugger::enable(Debugger::DEVELOPMENT);

$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(__DIR__ . '/Commons');
$loader->setTempDirectory(__DIR__ . '/temp');
$loader->register();

const AOC_INPUTS = __DIR__ . '/inputs/';
