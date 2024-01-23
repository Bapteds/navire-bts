<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortRepository::class)]
#[Assert\Unique(fields: ['indicatif'])]
#[ORM\Index(name:'ind_INDICATIF',columns:['indicatif'])]
class Port {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'nom', length: 70)]
    private ?string $nom = null;

    #[ORM\Column(name: 'indicatif', length: 5)]
    #[Assert\Regex('/[A-Z]{5}/', message: 'L\'indicatif Port a strictement 5 caractères')]
    private ?string $indicatif = null;

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
}
