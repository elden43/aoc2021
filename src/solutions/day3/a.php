<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$input = InputLoader::linesToArray(AOC_INPUTS . "day3/input.txt");

$repeats = strlen($input[0]);
$gammaRate = '';
$epsilonRate = '';

for($i = 0; $i < $repeats; $i++) {
	$lineCount = 0;
	$zeroCount = 0;
	foreach ($input as $line) {
		if($line[$i] === '0') {
			$zeroCount++;
		}
		$lineCount++;
	}
	$gammaRate .= ($zeroCount > ($lineCount / 2) ? '0' : '1');
}
$mask = '';
$mask = str_pad($mask, $repeats, "1");
$epsilonRate = bindec($mask) - bindec($gammaRate);
$gammaRate = bindec($gammaRate);

echo $gammaRate * $epsilonRate;

