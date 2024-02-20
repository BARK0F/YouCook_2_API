<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ToolCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]
#[Get(normalizationContext: ['groups' => ['ToolCategory_read']])]
#[GetCollection(normalizationContext: ['groups' => ['ToolCategory_read']])]
#[ORM\Entity(repositoryClass: ToolCategoryRepository::class)]
class ToolCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('ToolCategory_read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('ToolCategory_read')]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'toolCategory', targetEntity: Tool::class)]
    #[Groups('ToolCategory_read')]
    private Collection $tools;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
    }
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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
            $tool->setToolCategory($this);
        }

        return $this;
    }

    public function removeTool(Tool $tool): static
    {
        if ($this->tools->removeElement($tool)) {
            // set the owning side to null (unless already changed)
            if ($tool->getToolCategory() === $this) {
                $tool->setToolCategory(null);
            }
        }

        return $this;
    }
}
