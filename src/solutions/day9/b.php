<?php

declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

const MAX_HEIGHT = 10;

$lowPoints = [];
$heightMap = [];
foreach (InputLoader::split(InputLoader::load(AOC_INPUTS . "day9/input.txt"), InputLoader::SPLIT_END_OF_LINE) as $row) {
    $heightMap[] = InputLoader::intArray(str_split($row));
}

foreach ($heightMap as $rowKey => $heightMapRow) {
    foreach ($heightMapRow as $columnKey => $heightmapItem) {
        if ($heightmapItem < getLowestAdjacentHeight($rowKey, $columnKey, $heightMap)) {
            $lowPoints[] = [$rowKey, $columnKey];
        }
    }
}

$basins = [];
foreach ($lowPoints as $lowPoint) {
    $basinMap = [];
    updateBasinMap($lowPoint[0], $lowPoint[1], $heightMap, $basinMap);
    $basins[] = count($basinMap);
}
rsort($basins);
echo $basins[0] * $basins[1] * $basins[2];

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

function updateBasinMap(int $row, int $column, array $map, array &$basinMap)
{
    $basinMap[$row . '-' . $column] = true;
    $steps = [-1, 1];
    foreach ($steps as $change) {
        if(isset($map[$row][$column + $change])) {
            if (($map[$row][$column + $change] === $map[$row][$column] + 1) && ($map[$row][$column + $change] !== 9)) {
                updateBasinMap($row, $column + $change, $map, $basinMap);
            }
        }
        if(isset($map[$row + $change][$column])) {
            if (($map[$row + $change][$column] === $map[$row][$column] + 1) && ($map[$row + $change][$column] !== 9)) {
                updateBasinMap($row + $change, $column, $map, $basinMap);
            }
        }
    }
}
