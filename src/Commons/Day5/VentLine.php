<?php
declare(strict_types=1);

namespace AOC\Commons\Day5;

class VentLine
{
	public int $startX;
	public int $endX;
	public int $startY;
	public int $endY;
	public bool $isDiagonal;
	public bool $isVertical;
	public bool $isHorizontal;

	public function __construct(array $input)
	{
		[$this->startX, $this->startY, $this->endX, $this->endY] = $input;
		$this->isDiagonal = !(($this->startX === $this->endX) || ($this->startY === $this->endY));
		$this->isVertical = $this->startX === $this->endX && $this->startY !== $this->endY;
		$this->isHorizontal = $this->startY === $this->endY && $this->startX !== $this->endX;
	}
}