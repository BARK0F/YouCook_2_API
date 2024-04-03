<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\ConstituteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]
#[Get(normalizationContext: ['groups' => 'Constitute_read'])]
#[GetCollection(normalizationContext: ['groups' => 'Constitute_read'])]
#[Post(security: 'user')]
#[Patch(security: 'user and user == object.getUser()')]
#[ORM\Entity(repositoryClass: ConstituteRepository::class)]
class Constitute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('Constitute_read')]
    private ?int $id = null;

    #[ORM\Column(type: Types::FLOAT, precision: 6, scale: 2)]
    #[Groups(['Constitute_read', 'recipe:read', 'recipe:details'])]
    private ?float $quantity = null;

    #[ORM\Column(length: 10)]
    #[Groups(['Constitute_read', 'recipe:read', 'recipe:details'])]
    private ?string $measure = null;

    #[ORM\ManyToOne(inversedBy: 'constitutes')]
    #[Groups('Constitute_read')]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'constitutes')]
    #[Groups(['Constitute_read', 'recipe:read', 'recipe:details'])]
    private ?Ingredient $ingredient = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    public function setMeasure(string $measure): static
    {
        $this->measure = $measure;

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

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
