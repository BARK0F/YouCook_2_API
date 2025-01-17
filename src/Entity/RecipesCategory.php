<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\RecipesCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[Get(normalizationContext: ['groups' => ['RecipesCategory_read']])]
#[GetCollection(normalizationContext: ['groups' => ['RecipesCategory_read']])]
#[ORM\Entity(repositoryClass: RecipesCategoryRepository::class)]
class RecipesCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('RecipesCategory_read')]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups('RecipesCategory_read')]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Recipe::class)]
    #[Groups('RecipesCategory_read')]
    private Collection $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
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

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): static
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->setCategory($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getCategory() === $this) {
                $recipe->setCategory(null);
            }
        }

        return $this;
    }
}
