<?php

declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

const MAX_HEIGHT = 10;

$lowPoints = [];
foreach (InputLoader::split(InputLoader::load(AOC_INPUTS . "day9/input.txt"), InputLoader::SPLIT_END_OF_LINE) as $row) {
    $heightMap[] = InputLoader::intArray(str_split($row));
}

foreach ($heightMap as $rowKey => $heightMapRow) {
    foreach ($heightMapRow as $columnKey => $heightmapItem) {
        if ($heightmapItem < getLowestAdjacentHeight($rowKey, $columnKey, $heightMap)) {
            $lowPoints[] = $heightmapItem;
        }        
    }
}

echo (array_sum($lowPoints) + count($lowPoints));


function getLowestAdjacentHeight(int $row, int $column, array $map): ?int 
{
    $minHeight = MAX_HEIGHT;
    $steps = [-1, 1];
    foreach ($steps as $change) {
        $minHeight = min($minHeight, $map[$row][$column + $change] ?? MAX_HEIGHT);
        $minHeight = min($minHeight, $map[$row + $change][$column] ?? MAX_HEIGHT);
    }

    return $minHeight;
}

