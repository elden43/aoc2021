<?php
declare(strict_types=1);

use AOC\Commons\Day5\VentLine;
use AOC\Commons\Day5\VentMap;
use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$input = InputLoader::intArray(InputLoader::split(InputLoader::load(AOC_INPUTS . "day7/input.txt"), InputLoader::SPLIT_COMMA));

[$min, $max] = [min($input), max($input)];

$costForPosition = [];

for ($i = $min; $i <= $max; $i++) {
    foreach ($input as $value) {
        $costForPosition[$i] += getFuelCost(max($i, $value) - min($i, $value));
    }
}

echo min($costForPosition);

/**
 * get gauss number
 * @param int $steps
 * @return int
 */
function getFuelCost(int $steps): int {
    return ($steps ** 2 + $steps) / 2;
}