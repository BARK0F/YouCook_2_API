<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use App\Repository\UserRepository;
use App\State\MeProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['User_read']]
        ),
        new Patch(
            normalizationContext: ['groups' => ['User_read']],
            denormalizationContext: ['groups' => ['user:write']],
            security: 'object === user',
        ),
        new Get(
            uriTemplate: '/me',
            openapiContext: [
                'summary' => 'Retrieves the connected user',
                'description' => 'Retrieves the connected user',
                'responses' => [
                    '200' => [
                        'description' => 'connected user resource',
                        'content' => [
                            'application/ld+json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User.jsonld-User_read',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            normalizationContext: ['groups' => ['User_read']],
            provider: MeProvider::class,
        ),
    ]
)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['User_read'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['User_read', 'user:write'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['User_read'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 30)]
    #[Groups(['User_read', 'user:write', 'recipe:read', 'recipe:details', 'recipe:post'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 40)]
    #[Groups(['User_read', 'user:write', 'recipe:read', 'recipe:details', 'recipe:post'])]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['User_read', 'user:write'])]
    private ?string $biography = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Recipe::class, orphanRemoval: true)]
    private Collection $recipes;

    #[ORM\ManyToMany(targetEntity: Allergen::class, inversedBy: 'users')]
    private Collection $allergens;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Mark::class, orphanRemoval: true)]
    private Collection $marks;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->allergens = new ArrayCollection();
        $this->marks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): static
    {
        $this->biography = $biography;

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
            $recipe->setAuthor($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): static
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getAuthor() === $this) {
                $recipe->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Allergen>
     */
    public function getAllergens(): Collection
    {
        return $this->allergens;
    }

    public function addAllergen(Allergen $allergen): static
    {
        if (!$this->allergens->contains($allergen)) {
            $this->allergens->add($allergen);
        }

        return $this;
    }

    public function removeAllergen(Allergen $allergen): static
    {
        $this->allergens->removeElement($allergen);

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
            $mark->setUser($this);
        }

        return $this;
    }

    public function removeMark(Mark $mark): static
    {
        if ($this->marks->removeElement($mark)) {
            // set the owning side to null (unless already changed)
            if ($mark->getUser() === $this) {
                $mark->setUser(null);
            }
        }

        return $this;
    }
}
