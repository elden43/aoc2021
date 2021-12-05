<?php

namespace AOC\Commons;

class FileLoader implements Loader
{
	static function load(string $identifier): string
	{
		return file_get_contents($identifier);
	}
}