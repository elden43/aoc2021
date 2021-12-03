<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once '../../bootstrap.php';

const FORWARD = 'forward';
const UP = 'up';
const DOWN = 'down';

$splitBy = '~[\s]+~';

$input = InputLoader::linesToArray(AOC_INPUTS . "day2/input.txt");

$horizontal = 0;
$depth = 0;
foreach ($input as $inputLine) {
	$command = InputLoader::split($inputLine, $splitBy);
	switch ($command[0]) {
		case FORWARD:
			$horizontal += $command[1];
			break;
		case UP:
			$depth -= $command[1];
			break;
		case DOWN:
			$depth += $command[1];
			break;
	}
}

echo $depth * $horizontal;
