<?php

namespace App\Entity;

use App\Entity\Pates;
use App\Entity\Pizza;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PatesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PatesRepository::class)]
class Pates
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\OneToMany(targetEntity: Pizza::class, mappedBy: 'pates')]
    private Collection $pates;

    public function __construct()
    {
        $this->pates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPates(): Collection
    {
        return $this->pates;
    }

    public function addPate(Pizza $pate): static
    {
        if (!$this->pates->contains($pate)) {
            $this->pates->add($pate);
            $pate->setPates($this);
        }

        return $this;
    }

    public function removePate(Pizza $pate): static
    {
        if ($this->pates->removeElement($pate)) {
            // set the owning side to null (unless already changed)
            if ($pate->getPates() === $this) {
                $pate->setPates(null);
            }
        }

        return $this;
    }
}
