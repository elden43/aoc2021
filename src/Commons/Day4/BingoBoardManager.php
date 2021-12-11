<?php

namespace AOC\Commons\Day4;

use AOC\Commons\InputLoader;
use JetBrains\PhpStorm\Pure;

class BingoBoardManager
{
	public const GAME_STATE_RUNNING = 'running';
	public const GAME_STATE_ENDED = 'ended';
	public const GAME_MODE_FIRST = 'firstwinningboard';
	public const GAME_MODE_LAST = 'lastwinningboard';

	/** @var BingoBoard[] $boards */
	public array $boards = [];

	public string $gameState = self::GAME_STATE_RUNNING;

	private array $winningBoards = [];
	private array $winningBoardsInLastTurn = [];

	private ?int $lastProcessedNumber;

	private ?string $gameMode;
	private ?array $results;

	public function __construct(string $gameMode)
	{
		$this->gameMode = $gameMode;
	}

	public function createFromInput(array $input)
	{
		foreach ($input as $board) {
			$createdBoard = new BingoBoard();
			$lineCounter = 0;
			foreach (InputLoader::split($board, InputLoader::SPLIT_END_OF_LINE) as $line) {
				$createdBoard->createLine($lineCounter, InputLoader::intArray(InputLoader::split($line, InputLoader::SPLIT_SPACE)));
				$lineCounter++;
			}
			$this->boards[] = $createdBoard;
		}
	}

	public function processNumber(int $number): void
	{
		if ($this->gameState === self::GAME_STATE_ENDED) return;
		$this->lastProcessedNumber = $number;

		foreach ($this->boards as $key => $board) {
			$board->markNumber($number);
			if ($board->isWinning()) {
				$this->winningBoards[] = $key;
				if ($this->gameMode === self::GAME_MODE_FIRST) {
					$this->gameState = self::GAME_STATE_ENDED;
				}
				if ($this->gameMode === self::GAME_MODE_LAST) {
					$this->results[] = $board->getUnmarkedNumbersSum() * $this->lastProcessedNumber;
					unset($this->boards[$key]);
				}
			}
		}


	}

	#[Pure] public function getResult(): int
	{
		$result = null;
		if ($this->gameMode === self::GAME_MODE_FIRST) {
			if ($this->gameState === self::GAME_STATE_ENDED) {
				foreach ($this->winningBoards as $winningBoardId) {
					$result += $this->boards[$winningBoardId]->getUnmarkedNumbersSum() * $this->lastProcessedNumber;
				}
			}

			return $result;
		}

		if ($this->gameMode === self::GAME_MODE_LAST) {
			return end($this->results);
		}


	}

}
