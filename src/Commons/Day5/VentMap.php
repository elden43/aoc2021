<?php
declare(strict_types=1);

namespace AOC\Commons\Day5;

class VentMap
{
	/** @var int[][] */
	public array $map = [];
	private bool $useDiagonalLines;

	/** @param VentLine[] $ventLineList */
	public function __construct(array $ventLineList, bool $useDiagonalLines)
	{
		$this->useDiagonalLines = $useDiagonalLines;
		foreach ($ventLineList as $ventLine) {
			$this->drawLine($ventLine);
		}
	}

	private function drawLine(VentLine $ventLine): void
	{
		if ($ventLine->isDiagonal && !$this->useDiagonalLines) {
			return;
		}
		if ($ventLine->isHorizontal) {
			for ($x = min($ventLine->startX, $ventLine->endX); $x <= max($ventLine->startX, $ventLine->endX); $x++) {
				if (!isset($this->map[$x][$ventLine->startY])) {
					$this->map[$x][$ventLine->startY] = 1;
				} else {
					$this->map[$x][$ventLine->startY]++;
				}
			}
		}
		if ($ventLine->isVertical) {
			for ($y = min($ventLine->startY, $ventLine->endY); $y <= max($ventLine->startY, $ventLine->endY); $y++) {
				if (!isset($this->map[$ventLine->startX][$y])) {
					$this->map[$ventLine->startX][$y] = 1;
				} else {
					$this->map[$ventLine->startX][$y]++;
				}
			}
		}
		if ($ventLine->isDiagonal) {
			$rangeX = range($ventLine->startX, $ventLine->endX);
			$rangeY = range($ventLine->startY, $ventLine->endY);

			$i = 0;
			while ($i < count($rangeX)){
				if (!isset($this->map[$rangeX[$i]][$rangeY[$i]])) {
					$this->map[$rangeX[$i]][$rangeY[$i]] = 1;
				} else {
					$this->map[$rangeX[$i]][$rangeY[$i]]++;
				}
				$i++;
			}
		}

	}

	public function getOverlappingCount(): int
	{
		$overlappingCount = 0;
		foreach ($this->map as $line) {
			foreach ($line as $field) {
				if ($field >= 2) {
					$overlappingCount++;
				}
			}
		}

		return $overlappingCount;
	}

}
