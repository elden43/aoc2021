<?php

namespace AOC\Commons;

interface Loader
{
	static function load(string $identifier): string;
}