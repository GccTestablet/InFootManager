<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 100, nullable: false)]
    private ?string $firstName;

    #[ORM\Column(length: 100, nullable: false)]
    private ?string $lastName;

    #[ORM\Column(length: 20, enumType: \PlayerCategoryEnumType::class)]
    private \PlayerCategoryEnumType $category;

    #[ORM\ManyToMany(targetEntity: Team::class, mappedBy: "players")]
    private Collection $teams;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "teams")]
    private ?User $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getTeams(): Collection
    {
        return $this->teams;
    }
}
