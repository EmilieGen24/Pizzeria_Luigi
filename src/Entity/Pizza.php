<?php

namespace App\Entity;

use App\Entity\Pates;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\IngredientClassique;
use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredient_special = null;

    /**
     * @var Collection<int, IngredientClassique>
     */
    #[ORM\ManyToMany(targetEntity: IngredientClassique::class, mappedBy: 'pizza')]
    private Collection $ingredientClassiques;

    #[ORM\ManyToOne(inversedBy: 'pates')]
    private ?Pates $pates = null;

    #[ORM\ManyToOne(inversedBy: 'pizzas')]
    private ?User $user = null;

    public function __construct()
    {
        $this->ingredientClassiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIngredientSpecial(): ?string
    {
        return $this->ingredient_special;
    }

    public function setIngredientSpecial(string $ingredient_special): static
    {
        $this->ingredient_special = $ingredient_special;

        return $this;
    }

    /**
     * @return Collection<int, IngredientClassique>
     */
    public function getIngredientClassiques(): Collection
    {
        return $this->ingredientClassiques;
    }

    public function addIngredientClassique(IngredientClassique $ingredientClassique): static
    {
        if (!$this->ingredientClassiques->contains($ingredientClassique)) {
            $this->ingredientClassiques->add($ingredientClassique);
            $ingredientClassique->addPizza($this);
        }

        return $this;
    }

    public function removeIngredientClassique(IngredientClassique $ingredientClassique): static
    {
        if ($this->ingredientClassiques->removeElement($ingredientClassique)) {
            $ingredientClassique->removePizza($this);
        }

        return $this;
    }

    public function getPates(): ?Pates
    {
        return $this->pates;
    }

    public function setPates(?Pates $pates): static
    {
        $this->pates = $pates;

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
}
