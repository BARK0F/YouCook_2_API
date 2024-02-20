<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ToolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]
#[Get(normalizationContext: ['groups' => ['Tool_read']])]
#[GetCollection(normalizationContext: ['groups' => ['Tool_read']])]
#[ORM\Entity(repositoryClass: ToolRepository::class)]
class Tool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('Tool_read')]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Groups('Tool_read')]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Recipe::class, mappedBy: 'tools')]
    private Collection $recipes;

    #[ORM\ManyToOne(inversedBy: 'tools')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('Tool_read')]
    private ?ToolCategory $toolCategory = null;

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
            $recipe->addTool($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        if ($this->recipes->removeElement($recipe)) {
            $recipe->removeTool($this);
        }

        return $this;
    }

    public function getToolCategory(): ?ToolCategory
    {
        return $this->toolCategory;
    }

    public function setToolCategory(?ToolCategory $toolCategory): static
    {
        $this->toolCategory = $toolCategory;

        return $this;
    }
}
