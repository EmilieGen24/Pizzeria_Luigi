<?php

namespace App\Entity;

use App\Entity\Pizza;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\IngredientClassique;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\IngredientClassiqueRepository;

#[ORM\Entity(repositoryClass: IngredientClassiqueRepository::class)]
class IngredientClassique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\ManyToMany(targetEntity: Pizza::class, inversedBy: 'ingredientClassiques')]
    private Collection $pizza;

    public function __construct()
    {
        $this->pizza = new ArrayCollection();
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

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizza(): Collection
    {
        return $this->pizza;
    }

    public function addPizza(Pizza $pizza): static
    {
        if (!$this->pizza->contains($pizza)) {
            $this->pizza->add($pizza);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): static
    {
        $this->pizza->removeElement($pizza);

        return $this;
    }
}
