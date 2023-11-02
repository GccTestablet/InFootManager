<?php

namespace App\Entity;

use App\Enum\PlayerCategoryEnumType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: '`players`')]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 100)]
    private string $firstName;

    #[ORM\Column(length: 100)]
    private string $lastName;

    #[ORM\Column(length: 20, enumType: PlayerCategoryEnumType::class)]
    private PlayerCategoryEnumType $category;

    #[ORM\ManyToMany(targetEntity: Team::class, mappedBy: "players")]
    private Collection $teams;

    #[ORM\OneToOne(inversedBy: "player", targetEntity: User::class)]
    #[ORM\JoinColumn(name:"user_id", referencedColumnName:"id", nullable:false)]
    private User $user;

    public function __construct() {
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCategory(): PlayerCategoryEnumType
    {
        return $this->category;
    }

    public function setCategory(PlayerCategoryEnumType $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTeams(): Collection
    {
        return $this->teams;
    }
}
