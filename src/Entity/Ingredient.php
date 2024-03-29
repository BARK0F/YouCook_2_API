<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[ApiResource(order: ['name' => 'ASC'])]
#[ApiFilter(OrderFilter::class, properties: ['name' => 'partial', 'description' => 'partial'])]
#[Get(normalizationContext: ['groups' => ['get_Ingredient', 'user_Ingredient']])]
#[GetCollection]
#[Patch]
#[Post]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Ingredient', 'user_Ingredient'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['get_Ingredient', 'user_Ingredient'])]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    private ?IngredientCategory $category = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    private ?Allergen $allergen = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: Constitute::class)]
    private Collection $constitutes;

    public function __construct()
    {
        $this->constitutes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCategory(): ?IngredientCategory
    {
        return $this->category;
    }

    public function setCategory(?IngredientCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAllergen(): ?Allergen
    {
        return $this->allergen;
    }

    public function setAllergen(?Allergen $allergen): static
    {
        $this->allergen = $allergen;

        return $this;
    }

    /**
     * @return Collection<int, Constitute>
     */
    public function getConstitutes(): Collection
    {
        return $this->constitutes;
    }

    public function addConstitute(Constitute $constitute): static
    {
        if (!$this->constitutes->contains($constitute)) {
            $this->constitutes->add($constitute);
            $constitute->setIngredient($this);
        }

        return $this;
    }

    public function removeConstitute(Constitute $constitute): static
    {
        if ($this->constitutes->removeElement($constitute)) {
            // set the owning side to null (unless already changed)
            if ($constitute->getIngredient() === $this) {
                $constitute->setIngredient(null);
            }
        }

        return $this;
    }
}
