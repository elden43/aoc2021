<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

const OXYGEN_RATING = '1';
const CO2_SCRUBBER_RATING = '0';

$input = $baseInput = InputLoader::linesToArray(AOC_INPUTS . "day3/input.txt");
$maxRepeats = strlen($input[0]);

for($i = 0; $i < $maxRepeats; $i++) {
	$lineCounter = 0;
	$zeroCount = 0;
	$oneCount = 0;
	$keep = null;

	//we are already there folks
	if (count($input) === 1) {
		continue;
	}

	foreach ($input as $line) {
		if($line[$i] === '0') {
			$zeroCount++;
		} else {
			$oneCount++;
		}
	}

	if ($zeroCount === $oneCount) {
		$keep = OXYGEN_RATING;
	} elseif ($zeroCount > $oneCount) {
		$keep = '0';
	} else {
		$keep = '1';
	}

	foreach ($input as $line) {
		if($line[$i] !== $keep) {
			unset($input[$lineCounter]);
		}
		$lineCounter++;
	}
	//refresh keys after unset
	$input = array_values($input);
}

$oxygen = bindec($input[0]);

$input = $baseInput;
for($i = 0; $i < $maxRepeats; $i++) {
	$lineCounter = 0;
	$zeroCount = 0;
	$oneCount = 0;
	$keep = null;

	//we are already there folks
	if (count($input) === 1) {
		continue;
	}

	foreach ($input as $line) {
		if($line[$i] === '0') {
			$zeroCount++;
		} else {
			$oneCount++;
		}
	}

	if ($zeroCount === $oneCount) {
		$keep = CO2_SCRUBBER_RATING;
	} elseif ($zeroCount < $oneCount) {
		$keep = '0';
	} else {
		$keep = '1';
	}

	foreach ($input as $line) {
		if($line[$i] !== $keep) {
			unset($input[$lineCounter]);
		}
		$lineCounter++;
	}
	//refresh keys after unset
	$input = array_values($input);
}

$co2 = bindec($input[0]);

echo $oxygen * $co2;