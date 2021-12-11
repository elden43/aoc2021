<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$input = InputLoader::intArray(InputLoader::linesToArray(AOC_INPUTS . "day1/input.txt"));

$lastSum = null;
$incremented = 0;
$i = 0;
foreach ($input as $value) {
    $i++;
    if ($i >=2) {
        $currentSum = $input[$i] + $input[$i-1] + $input[$i-2];
        if ($lastSum && ($currentSum > $lastSum)) {
            $incremented++;
        }
        $lastSum = $currentSum;
    }
}

echo $incremented;