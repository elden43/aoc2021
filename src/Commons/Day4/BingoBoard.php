<?php
declare(strict_types=1);

namespace AOC\Commons\Day4;

use JetBrains\PhpStorm\Pure;

class BingoBoard
{
	/** @var array[][] $board */
	public array $board;

	public function createLine(int $lineNumber, array $numbers)
	{
		$position = 0;
		foreach ($numbers as $number) {
			$this->board[$lineNumber][$position] = new BingoField($number);
			$position++;
		}
	}

	public function markNumber(int $number): void
	{
		foreach ($this->board as $line) {
			/** @var BingoField $field */
			foreach ($line as $field) {
				$field->markNumber($number);
			}
		}
	}

	#[Pure] public function isWinning(): bool
	{
		return $this->checkRowsForCompletion() || $this->checkColumnsForCompletion();
	}

	/**
	 * @return bool
	 */
	#[Pure] private function checkRowsForCompletion(): bool
	{
		foreach ($this->board as $lines) {
			/** @var BingoField $number */
			foreach ($lines as $number) {
				if (!$number->isChecked()) {
					continue 2;
				}
			}
			return true;
		}
		return false;
	}

	#[Pure] private function checkColumnsForCompletion(): bool
	{
		for ($j = 0; $j < count($this->board[0]); $j++) {
			for ($i = 0; $i < count($this->board); $i++) {
				/** @var BingoField $number */
				$number = $this->board[$i][$j];
				if (!$number->isChecked()) {
					continue 2;
				}
			}
			return true;
		}

		return false;
	}

	#[Pure] public function getUnmarkedNumbersSum(): int
	{
		$result = 0;
		foreach ($this->board as $lines) {
			/** @var BingoField $number */
			foreach ($lines as $number) {
				$result += !$number->isChecked() ? $number->getNumber() : 0;
			}
		}

		return $result;
	}

}
