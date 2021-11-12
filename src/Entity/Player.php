<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
#[ApiResource]
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity=Game::class, mappedBy="player", cascade={"persist", "remove"})
     */
    private $game;

    /**
     * @ORM\Column(type="integer")
     */
    private $x=0;

    /**
     * @ORM\Column(type="integer")
     */
    private $y=0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        // set the owning side of the relation if necessary
        if ($game->getPlayer() !== $this) {
            $game->setPlayer($this);
        }

        $this->game = $game;

        return $this;
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

	public function setPosition(int $x, int $y)
	{
		if (! (0 <= $x && $x < Game::DEFAULT_MAP_WIDTH)) {
			throw new \Exception(Game::ERROR_INVALID_PLAYER_POSITION . '(x='.$x.')');
		}
		if (! (0 <= $y && $y < Game::DEFAULT_MAP_HEIGHT)) {
			throw new \Exception(Game::ERROR_INVALID_PLAYER_POSITION . '(y='.$y.')');
		}

		$this->x = $x;
		$this->y = $y;
	}
}
