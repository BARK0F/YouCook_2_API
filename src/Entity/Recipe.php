<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 15)]
    private ?string $difficulty = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $nbPeople = null;

    #[ORM\Column]
    private ?int $nbDay = null;

    #[ORM\Column]
    private ?int $nbHour = null;

    #[ORM\Column]
    private ?int $nbMinute = null;

    #[ORM\ManyToMany(targetEntity: Tool::class, inversedBy: 'recipes')]
    private Collection $tools;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    private ?RecipesCategory $category = null;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Constitute::class, orphanRemoval: true)]
    private Collection $constitutes;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Mark::class, orphanRemoval: true)]
    private Collection $marks;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Step::class, orphanRemoval: true)]
    private Collection $steps;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
        $this->constitutes = new ArrayCollection();
        $this->marks = new ArrayCollection();
        $this->steps = new ArrayCollection();
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

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNbPeople(): ?int
    {
        return $this->nbPeople;
    }

    public function setNbPeople(int $nbPeople): static
    {
        $this->nbPeople = $nbPeople;

        return $this;
    }

    public function getNbDay(): ?int
    {
        return $this->nbDay;
    }

    public function setNbDay(int $nbDay): static
    {
        $this->nbDay = $nbDay;

        return $this;
    }

    public function getNbHour(): ?int
    {
        return $this->nbHour;
    }

    public function setNbHour(int $nbHour): static
    {
        $this->nbHour = $nbHour;

        return $this;
    }

    public function getNbMinute(): ?int
    {
        return $this->nbMinute;
    }

    public function setNbMinute(int $nbMinute): static
    {
        $this->nbMinute = $nbMinute;

        return $this;
    }

    /**
     * @return Collection<int, Tool>
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): static
    {
        if (!$this->tools->contains($tool)) {
            $this->tools->add($tool);
        }

        return $this;
    }

    public function removeTool(Tool $tool): static
    {
        $this->tools->removeElement($tool);

        return $this;
    }

    public function getCategory(): ?RecipesCategory
    {
        return $this->category;
    }

    public function setCategory(?RecipesCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

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
            $constitute->setRecipe($this);
        }

        return $this;
    }

    public function removeConstitute(Constitute $constitute): static
    {
        if ($this->constitutes->removeElement($constitute)) {
            // set the owning side to null (unless already changed)
            if ($constitute->getRecipe() === $this) {
                $constitute->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getMarks(): Collection
    {
        return $this->marks;
    }

    public function addMark(Mark $mark): static
    {
        if (!$this->marks->contains($mark)) {
            $this->marks->add($mark);
            $mark->setRecipe($this);
        }

        return $this;
    }

    public function removeMark(Mark $mark): static
    {
        if ($this->marks->removeElement($mark)) {
            // set the owning side to null (unless already changed)
            if ($mark->getRecipe() === $this) {
                $mark->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Step>
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): static
    {
        if (!$this->steps->contains($step)) {
            $this->steps->add($step);
            $step->setRecipe($this);
        }

        return $this;
    }

    public function removeStep(Step $step): static
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getRecipe() === $this) {
                $step->setRecipe(null);
            }
        }

        return $this;
    }
}