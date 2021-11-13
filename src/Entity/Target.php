<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TargetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TargetRepository::class)
 */
#[ApiResource]
class Target
{
	const DEFAULT_MAX_HITS = 3;
	const MIN_DISTANCE_VISIBILITY = 2;

	/**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $x=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $y=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $hits=self::DEFAULT_MAX_HITS;

    /**
     * @ORM\OneToOne(targetEntity=Game::class, mappedBy="target", cascade={"persist", "remove"})
     */
    private $game;
	/**
	 * @var bool
	 */
	private $visible = false;

	public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getHits(): ?int
    {
        return $this->hits;
    }

    public function setHits(int $hits): self
    {
        $this->hits = $hits;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        // set the owning side of the relation if necessary
        if ($game->getTarget() !== $this) {
            $game->setTarget($this);
        }

        $this->game = $game;

        return $this;
    }

	public function setPosition(int $x, int $y)
	{
		if (! (0 <= $x && $x < Game::DEFAULT_MAP_WIDTH)) {
			throw new \Exception(Game::ERROR_INVALID_TARGET_POSITION.'(x='.$x.')');
		}
		if (! (0 <= $y && $y < Game::DEFAULT_MAP_HEIGHT)) {
			throw new \Exception(Game::ERROR_INVALID_TARGET_POSITION.'(y='.$y.')');
		}

		$this->x = $x;
		$this->y = $y;
	}

	public function setVisibleToPlayer()
	{
		$this->visible = true;
	}

	public function setInvisibleToPlayer()
	{
		$this->visible = false;
	}

	public function setPlayerVisibility(Player $player)
	{
		$this->setInvisibleToPlayer();

		$position1 = new Position($player->getX(), $player->getY());
		$position2 = new Position($this->getX(), $this->getY());

		if (Game::getDistance($position1, $position2) <= Target::MIN_DISTANCE_VISIBILITY){
			$this->setVisibleToPlayer();
		}
	}

	public function hit() {
		$this->setHits($this->getHits() -  1);
	}
}
