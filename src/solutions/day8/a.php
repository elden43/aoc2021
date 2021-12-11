<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$input = InputLoader::split(InputLoader::load(AOC_INPUTS . "day8/input.txt"), InputLoader::SPLIT_END_OF_LINE);

$resultCount = 0;

foreach ($input as $line) {
    foreach (InputLoader::split(InputLoader::split($line, InputLoader::SPLIT_PIPE)[1], InputLoader::SPLIT_SPACE) as $resultItem){
        if (strlen($resultItem) === 2 || strlen($resultItem) === 3 || strlen($resultItem) === 4 || strlen($resultItem) === 7) {
            $resultCount++;
        }
    }
}

echo $resultCount;