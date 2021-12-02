<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$input = InputLoader::intArray(InputLoader::linesToArray(AOC_INPUTS . "day1/input.txt"));

$lastValue = null;
$incremented = 0;
foreach ($input as $value) {
    if ($lastValue && ($value > $lastValue)) {
        $incremented++;
    }

    $lastValue = $value;
}

echo $incremented;