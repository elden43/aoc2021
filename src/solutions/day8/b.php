<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$input = InputLoader::split(InputLoader::load(AOC_INPUTS . "day8/input.txt"), InputLoader::SPLIT_END_OF_LINE);
$result = 0;
foreach ($input as $line) {
    $combinations = new \Day8\DisplayCombinations(InputLoader::split(InputLoader::split($line, InputLoader::SPLIT_PIPE)[0], InputLoader::SPLIT_SPACE), InputLoader::split(InputLoader::split($line, InputLoader::SPLIT_PIPE)[1], InputLoader::SPLIT_SPACE));
    $result += $combinations->getResult();
}

echo $result;