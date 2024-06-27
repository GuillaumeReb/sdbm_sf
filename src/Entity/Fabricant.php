<?php

namespace App\Entity;

use App\Repository\FabricantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FabricantRepository::class)]
class Fabricant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nomFabricant = null;

    /**
     * @var Collection<int, Marque>
     */
    #[ORM\OneToMany(targetEntity: Marque::class, mappedBy: 'fabricants')]
    private Collection $marques;

    public function __construct()
    {
        $this->marques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFabricant(): ?string
    {
        return $this->nomFabricant;
    }

    public function setNomFabricant(string $nomFabricant): static
    {
        $this->nomFabricant = $nomFabricant;

        return $this;
    }

    /**
     * @return Collection<int, Marque>
     */
    public function getMarques(): Collection
    {
        return $this->marques;
    }

    public function addMarque(Marque $marque): static
    {
        if (!$this->marques->contains($marque)) {
            $this->marques->add($marque);
            $marque->setFabricants($this);
        }

        return $this;
    }

    public function removeMarque(Marque $marque): static
    {
        if ($this->marques->removeElement($marque)) {
            // set the owning side to null (unless already changed)
            if ($marque->getFabricants() === $this) {
                $marque->setFabricants(null);
            }
        }

        return $this;
    }
}
