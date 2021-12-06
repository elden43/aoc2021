<?php
declare(strict_types=1);

use AOC\Commons\Day5\VentLine;
use AOC\Commons\Day5\VentMap;
use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$splitBy = "~(\,)|( -> )~";
$input = InputLoader::split(InputLoader::load(AOC_INPUTS . "day5/input.txt"), InputLoader::SPLIT_END_OF_LINE);
$ventLineList = [];

foreach ($input as $line) {
	$ventLineList[] = new VentLine(InputLoader::intArray(InputLoader::split($line, $splitBy)));
}
$map = new VentMap($ventLineList, true);
echo $map->getOverlappingCount();
