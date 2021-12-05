<?php
declare(strict_types=1);

namespace AOC\Commons;

class InputLoader extends FileLoader
{
	public const SPLIT_EMPTY_LINE = "~((\r\n){2,})|((\n){2,})|((\r){2,})~";
	public const SPLIT_END_OF_LINE = "~\r\n|\r|\n~";
	public const SPLIT_SPACE = "~[\s+]~";
	public const SPLIT_COMMA = "~(\,)~";


    public static function linesToArray(string $pathToFile): array
    {
        return preg_split(self::SPLIT_END_OF_LINE, self::load($pathToFile));
    }

    public static function intArray(array $array): array
    {
        return array_map('intval', $array);
    }

	public static function split(string $input, string $pattern): array
	{
		return preg_split($pattern, $input, 0, PREG_SPLIT_NO_EMPTY);
	}

}
