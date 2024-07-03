<?php

namespace App\Entity;

use App\Repository\ContinentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContinentRepository::class)]
class Continent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    //unique pour eviter la répétition des couleurs, une seule brune. penser a faire le 'symfony console make:migration' et 'symfony console doctrine:migrations:migrate'
    #[ORM\Column(length: 50, unique:true)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Pays>
     */
    #[ORM\OneToMany(targetEntity: Pays::class, mappedBy: 'continents')]
    private Collection $pays;

    public function __construct()
    {
        $this->pays = new ArrayCollection();
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
     * @return Collection<int, Pays>
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): static
    {
        if (!$this->pays->contains($pay)) {
            $this->pays->add($pay);
            $pay->setContinents($this);
        }

        return $this;
    }


    public function __toString()
    {
        return $this->nom;
    }

    public function removePay(Pays $pay): static
    {
        if ($this->pays->removeElement($pay)) {
            // set the owning side to null (unless already changed)
            if ($pay->getContinents() === $this) {
                $pay->setContinents(null);
            }
        }

        return $this;
    }
}
