<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'pays')]
#[Assert\Unique(fields: ['indicatif'])]
#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ORM\Index(name: 'ind_indicatif', columns: ['indicatif'])]
class Pays {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'nom', length: 70)]
    private ?string $nom = null;

    #[ORM\Column(name: 'indicatif', length: 3)]
    #[Assert\Regex('/[A-Z]{3}/', message: 'L\'indicatif Pays a strictement 3 caractères')]
    private ?string $indicatif = null;

    #[ORM\OneToMany(mappedBy: 'idpays', targetEntity: Navire::class)]
    private Collection $navires;

    public function __construct() {
        $this->navires = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): static {
        $this->nom = $nom;

        return $this;
    }

    public function getIndicatif(): ?string {
        return $this->indicatif;
    }

    public function setIndicatif(string $indicatif): static {
        $this->indicatif = $indicatif;

        return $this;
    }

    /**
     * @return Collection<int, Navire>
     */
    public function getNavires(): Collection {
        return $this->navires;
    }

    public function addNavire(Navire $navire): static {
        if (!$this->navires->contains($navire)) {
            $this->navires->add($navire);
            $navire->setIdpays($this);
        }

        return $this;
    }

    public function removeNavire(Navire $navire): static {
        if ($this->navires->removeElement($navire)) {
            // set the owning side to null (unless already changed)
            if ($navire->getIdpays() === $this) {
                $navire->setIdpays(null);
            }
        }

        return $this;
    }
}
