<?php

declare(strict_types=1);

namespace App\Entity;

class Position
{
	private int $x;
	private int $y;

	public function __construct(int $x, int $y)
	{
		$this->setX($x);
		$this->setY($y);
	}

	/**
	 * @return int
	 */
	public function getX(): int
	{
		return $this->x;
	}

	/**
	 * @param int $x
	 * @return Position
	 */
	public function setX(int $x): Position
	{
		$this->x = $x;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getY(): int
	{
		return $this->y;
	}

	/**
	 * @param int $y
	 * @return Position
	 */
	public function setY(int $y): Position
	{
		$this->y = $y;
		return $this;
	}
}