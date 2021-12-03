<?php
declare(strict_types=1);

namespace AOC\Commons;

class InputLoader
{
    public static function linesToArray(string $pathToFile): array
    {
        return preg_split('~\r\n|\r|\n~', file_get_contents($pathToFile));
    }

    public static function intArray(array $array): array
    {
        return array_map('intval', $array);
    }

	public static function split(string $input, string $pattern): array
	{
		return preg_split($pattern, $input);
	}
}