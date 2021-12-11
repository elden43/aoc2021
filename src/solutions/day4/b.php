<?php
declare(strict_types=1);

use AOC\Commons\InputLoader;

include_once "../../bootstrap.php";

$input = InputLoader::split(file_get_contents(AOC_INPUTS . "day4/input.txt"), InputLoader::SPLIT_EMPTY_LINE);
[$numbers, $boards] = [InputLoader::intArray(InputLoader::split(array_splice($input, 0, 1)[0], "~(\,)~")), $input];

$boardsManager = new \AOC\Commons\Day4\BingoBoardManager(\AOC\Commons\Day4\BingoBoardManager::GAME_MODE_LAST);
$boardsManager->createFromInput($boards);

$step = 0;

foreach ($numbers as $number) {
	$step++;
	$boardsManager->processNumber($number);
	if ($step < 5) {
		continue;
	}
}

echo $boardsManager->getResult();

