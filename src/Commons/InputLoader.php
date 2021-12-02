<?php

namespace AOC\Commons;

class InputLoader
{
    public static function linesToArray(string $pathToFile): array
    {
        return preg_split('/\r\n|\r|\n/', file_get_contents($pathToFile));
    }

    public static function intArray(array $array): array
    {
        return array_map('intval', $array);
    }
}