<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Player::class, inversedBy: "teams")]
    #[ORM\JoinTable(name: "player_team")]
    private Collection $players;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player)
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->addTeam($this);
        }
    }

    public function removePlayer(Player $player)
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            $player->removeTeam($this);
        }
    }
}
