<?php

namespace App\Entity;

use App\Repository\MarkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarkRepository::class)]
class Mark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $mark = null;

    #[ORM\ManyToOne(inversedBy: 'marks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'marks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?float
    {
        return $this->mark;
    }

    public function setMark(float $mark): static
    {
        $this->mark = $mark;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }
}
