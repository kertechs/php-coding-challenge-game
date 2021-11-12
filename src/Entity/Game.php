<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
#[ApiResource]
class Game
{
	const DEFAULT_MAP_WIDTH = 12;
	const DEFAULT_MAP_HEIGHT = 12;
	const ERROR_INVALID_PLAYER_POSITION = 'Position du joueur impossible.';
	const ERROR_INVALID_TARGET_POSITION = 'Position de la cible impossible.';
	const STATE_NEW = 1;

	/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Player::class, inversedBy="game", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\OneToOne(targetEntity=Target::class, inversedBy="game", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $target;

	public static function getDistance(Position $position1, Position $position2)
	{
		return sqrt(
						pow( ($position1->getX() - $position2->getX()), 2 )
						+    pow( ($position1->getY() - $position2->getY()), 2 )
		);
	}

	public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getTarget(): ?Target
    {
        return $this->target;
    }

    public function setTarget(Target $target): self
    {
        $this->target = $target;

        return $this;
    }
}
