<?php
declare(strict_types=1);
ini_set('memory_limit', '16G');
ini_set('max_execution_time ', '3000');
set_time_limit(3000);

use AOC\Commons\Day5\VentLine;
use AOC\Commons\Day5\VentMap;
use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$days = 256;
$input = InputLoader::intArray(InputLoader::split(InputLoader::load(AOC_INPUTS . "day6/input.txt"), InputLoader::SPLIT_COMMA));
dump($input);
$swarm = [];
foreach ($input as $fish) {
	$swarm[$fish] = ($swarm[$fish] ?? 0) + 1;
}
$swarm = $swarm + [6 => 0, 7 => 0, 8 => 0, 0 => 0];

for ($i = 0; $i < $days; $i++) {
	$newGeneration = [];
	foreach ($swarm as $oldKey => $oldValue) {
		if ($oldKey === 0) {
			$newGeneration[8] = $oldValue;
			$newGeneration[6] = ($newGeneration[6] ?? 0) + $oldValue;
		} else {
			$newGeneration[$oldKey - 1] = ($newGeneration[$oldKey - 1] ?? 0) + $oldValue;
		}
	}
	$swarm = $newGeneration;
}

echo array_sum($swarm);