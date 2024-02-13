<?php

namespace App\Entity;

use App\Repository\ConstituteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConstituteRepository::class)]
class Constitute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::FLOAT, precision: 6, scale: 2)]
    private ?float $quantity = null;

    #[ORM\Column(length: 10)]
    private ?string $measure = null;

    #[ORM\ManyToOne(inversedBy: 'constitutes')]
    private ?Recipe $recipe = null;

    #[ORM\ManyToOne(inversedBy: 'constitutes')]
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
