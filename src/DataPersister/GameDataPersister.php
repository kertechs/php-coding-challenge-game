<?php

declare(strict_types=1);

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Game;
use App\Entity\Target;
use Doctrine\ORM\EntityManagerInterface;

class GameDataPersister implements DataPersisterInterface
{
	private $decoratedDataPersister;

	public function __construct(DataPersisterInterface $decoratedDataPersister)
	{
		$this->decoratedDataPersister = $decoratedDataPersister;
	}

	public function supports($data): bool
	{
		return $data instanceof Game;
	}

	/**
	 * @param Game $data
	 */
	public function persist($data)
	{
		$player = $data->getPlayer();
		$playerDefaultXPos = (int) Game::DEFAULT_MAP_WIDTH/2;
		$playerDefaultYPos = (int) Game::DEFAULT_MAP_HEIGHT/2;
		$player->setPosition($playerDefaultXPos, $playerDefaultYPos);
		$data->setPlayer($player);

		$target = new Target();
		$targetDefaultXPos = rand(0, Game::DEFAULT_MAP_WIDTH - 1);
		$targetDefaultYPos = rand(0, Game::DEFAULT_MAP_HEIGHT - 1);
		$target->setPosition($targetDefaultXPos, $targetDefaultYPos);
		$data->setTarget($target);

		$data->setState(Game::STATE_NEW);

		return $this->decoratedDataPersister->persist($data);
		/*
		$this->entityManager->persist($player);
		$this->entityManager->persist($target);
		$this->entityManager->persist($data);

		$this->entityManager->flush();*/
	}

	public function remove($data)
	{
		/*$this->entityManager->remove($data);
		$this->entityManager->flush();*/

		$this->decoratedDataPersister->remove($data);
	}
}
