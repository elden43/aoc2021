<?php

namespace AOC\Commons\Day4;

class BingoField
{
	private int $number;
	private bool $checked = false;

	public function __construct(int $number)
	{
		$this->number = $number;
	}

	public function markNumber(int $number)
	{
		if ($this->number === $number) {
			$this->checked = true;
		}
	}

	public function isChecked()
	{
		return $this->checked;
	}

	public function getNumber()
	{
		return $this->number;
	}
}
