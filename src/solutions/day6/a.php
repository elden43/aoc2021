<?php
declare(strict_types=1);

use AOC\Commons\Day5\VentLine;
use AOC\Commons\Day5\VentMap;
use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$days = 80;
$input = InputLoader::intArray(InputLoader::split(InputLoader::load(AOC_INPUTS . "day6/input.txt"), InputLoader::SPLIT_COMMA));

for ($i = 0; $i < $days; $i++) {
	$nextGeneration = [];
	foreach ($input as $key => $fish) {
		$fish--;
		if ($fish === -1) {
			$fish = 6;
			$nextGeneration[] = 8;
		}
		$nextGeneration[] = $fish;
	}
	$input = $nextGeneration;
}
echo count($input);