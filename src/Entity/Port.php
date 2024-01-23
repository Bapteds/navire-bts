<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortRepository::class)]
#[Assert\Unique(fields: ['indicatif'])]
#[ORM\Index(name: 'ind_INDICATIF', columns: ['indicatif'])]
class Port {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'nom', length: 70)]
    private ?string $nom = null;

    #[ORM\Column(name: 'indicatif', length: 5)]
    #[Assert\Regex('/[A-Z]{5}/', message: 'L\'indicatif Port a strictement 5 caractères')]
    private ?string $indicatif = null;

    #[ORM\ManyToMany(targetEntity: AisShipType::class, inversedBy: 'portsCompatibles')]
    #[ORM\JoinTable(name: 'porttypecompatible')]
    #[ORM\joinColumn(name: 'idport', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name:'idaisshiptype', referencedColumnName:'id')]
    private Collection $types;

    public function __construct() {
        $this->types = new ArrayCollection();
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
     * @return Collection<int, AisShipType>
     */
    public function getTypes(): Collection {
        return $this->types;
    }

    public function addType(AisShipType $type): static {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(AisShipType $type): static {
        $this->types->removeElement($type);

        return $this;
    }
}
