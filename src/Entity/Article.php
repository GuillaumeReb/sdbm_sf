<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nomArticle = null;

    #[ORM\Column]
    private ?float $prixAchat = null;

    #[ORM\Column(nullable: true)]
    private ?int $volume = null;

    #[ORM\Column(nullable: true)]
    private ?float $titrage = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $marques = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Couleur $couleurs = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Typebiere $types = null;

    /**
     * @var Collection<int, Vendre>
     */
    #[ORM\OneToMany(targetEntity: Vendre::class, mappedBy: 'article')]
    private Collection $vendres;

    public function __construct()
    {
        $this->vendres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setNomArticle(string $nomArticle): static
    {
        $this->nomArticle = $nomArticle;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(float $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): static
    {
        $this->volume = $volume;

        return $this;
    }

    public function getTitrage(): ?float
    {
        return $this->titrage;
    }

    public function setTitrage(?float $titrage): static
    {
        $this->titrage = $titrage;

        return $this;
    }

    public function getMarques(): ?Marque
    {
        return $this->marques;
    }

    public function setMarques(?Marque $marques): static
    {
        $this->marques = $marques;

        return $this;
    }

    public function getCouleurs(): ?Couleur
    {
        return $this->couleurs;
    }

    public function setCouleurs(?Couleur $couleurs): static
    {
        $this->couleurs = $couleurs;

        return $this;
    }

    public function getTypes(): ?Typebiere
    {
        return $this->types;
    }

    public function setTypes(?Typebiere $types): static
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection<int, Vendre>
     */
    public function getVendres(): Collection
    {
        return $this->vendres;
    }

    public function addVendre(Vendre $vendre): static
    {
        if (!$this->vendres->contains($vendre)) {
            $this->vendres->add($vendre);
            $vendre->setArticle($this);
        }

        return $this;
    }

    public function removeVendre(Vendre $vendre): static
    {
        if ($this->vendres->removeElement($vendre)) {
            // set the owning side to null (unless already changed)
            if ($vendre->getArticle() === $this) {
                $vendre->setArticle(null);
            }
        }

        return $this;
    }
}
