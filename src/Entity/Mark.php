<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\MarkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[Get(normalizationContext: ['groups' => ['Mark_read']])]
#[Patch(
    normalizationContext: ['groups' => ['Mark_read']],
    denormalizationContext: ['groups' => ['Mark_write']])]
#[Post(security: 'user')]
#[GetCollection(normalizationContext: ['groups' => ['Mark_read']])]
#[ORM\Entity(repositoryClass: MarkRepository::class)]
class Mark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Mark_read', 'Mark_write'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['Mark_read', 'Mark_write', 'recipe:read', 'recipe:details'])]
    private ?float $mark = null;

    #[ORM\ManyToOne(inversedBy: 'marks')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Mark_read', 'Mark_write', 'recipe:read', 'recipe:details'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'marks')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['Mark_read', 'Mark_write'])]
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
