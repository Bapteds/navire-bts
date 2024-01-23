<?php

namespace App\Entity;

use App\Repository\NavireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NavireRepository::class)]
#[ORM\Index(name: 'ind_IMO', columns: ['imo'])]
#[ORM\Index(name: 'ind_MMSI', columns: ['mmsi'])]
class Navire {

    #[Assert\Unique(fields: ['imo', 'mmsi', 'indicatifAppel'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'imo', length: 7, unique: true)]
    #[Assert\Regex('[1-9]{7}', message: 'Le numéro IMO doit être unique et composé de 7 chiffres sans commencer par 0')]
    private ?string $IMO = null;

    #[ORM\Column(name: 'nom', length: 50)]
    #[Assert\Regex('[aA-zZ]{3,}', message: 'Le nom doit au minimum avoir 3 lettres')]
    private ?string $Nom = null;

    #[ORM\Column(name: 'mmsi', unique: true)]
    #[Assert\Regex('[1-9]{9}', message: 'Le numéro MMSI doit être unique et composé de 9 chiffres sans commencer par 0')]
    private ?int $MMSI = null;

    #[ORM\Column(name: 'indicatif', length: 10)]
    #[Assert\Regex('[aA-zZ]{10}', message: 'L\'indicatif doit faire 10 lettres')]
    private ?string $Indicatif = null;

    #[ORM\Column(name: 'eta', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Eta = null;

    #[ORM\Column(name: 'longueur')]
    #[Assert\Regex('[1-9]', message: 'La longueur ne peut pas être négative')]
    private ?int $longueur = null;

    #[ORM\Column(name: 'largeur')]
    #[Assert\Regex('[1-9]', message: 'La largeur ne peut pas être négative')]
    private ?int $largeur = null;

    #[ORM\Column(name: 'tirantdeau')]
    private ?float $tirantdeau = null;

    #[ORM\ManyToOne(inversedBy: 'navires')]
    #[ORM\JoinColumn(name: 'idaisshiptype', referencedColumnName: 'id', nullable: false)]
    private ?AisShipType $idaisshiptype = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'idpays', referencedColumnName: 'id', nullable: false)]
    private ?Pays $pavillon = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getIMO(): ?string {
        return $this->IMO;
    }

    public function getNom(): ?string {
        return $this->Nom;
    }

    public function setNom(string $Nom): static {
        $this->Nom = $Nom;

        return $this;
    }

    public function getMMSI(): ?int {
        return $this->MMSI;
    }

    public function setMMSI(int $MMSI): static {
        $this->MMSI = $MMSI;

        return $this;
    }

    public function getIndicatif(): ?string {
        return $this->Indicatif;
    }

    public function setIndicatif(string $Indicatif): static {
        $this->Indicatif = $Indicatif;

        return $this;
    }

    public function getEta(): ?\DateTimeInterface {
        return $this->Eta;
    }

    public function setEta(\DateTimeInterface $Eta): static {
        $this->Eta = $Eta;

        return $this;
    }

    public function getLongueur(): ?int {
        return $this->longueur;
    }

    public function setLongueur(int $longueur): static {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?int {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): static {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTirantdeau(): ?float {
        return $this->tirantdeau;
    }

    public function setTirantdeau(float $tirantdeau): static {
        $this->tirantdeau = $tirantdeau;

        return $this;
    }

    public function getIdaisshiptype(): ?AisShipType {
        return $this->idaisshiptype;
    }

    public function setIdaisshiptype(?AisShipType $idaisshiptype): static {
        $this->idaisshiptype = $idaisshiptype;

        return $this;
    }

    public function getPavillon(): ?Pays {
        return $this->pavillon;
    }

    public function setPavillon(?Pays $idpays): static {
        $this->pavillon = $pavillon;

        return $this;
    }
}
