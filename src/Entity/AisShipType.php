<?php

namespace App\Entity;

use App\Repository\AisShipTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table (name:'aisshiptype')]
#[ORM\Entity(repositoryClass: AisShipTypeRepository::class)]
class AisShipType
{
    #[Assert\Unique(fileds:['aisShipType'])]
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name:'id')]
    private ?int $id = null;

    
    
    #[ORM\Column (name:'aisshiptype')]
    #[Assert\Rancge(
            min:1,
            ma:9,
            notInRangeMessage:'Le type AIS doit être compris entre {{ min }} et {{ max }}'
    )]
    private ?int $aisShipType = null;

    #[ORM\Column(name:'libelle',length: 60)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'idaisshiptype', targetEntity: Navire::class)]
    private Collection $navires;

    #[ORM\ManyToMany(targetEntity: Port::class, mappedBy: 'types')]
    private Collection $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAisShipType(): ?int
    {
        return $this->aisShipType;
    }

    public function setAisShipType(int $aisShipType): static
    {
        $this->aisShipType = $aisShipType;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Navire>
     */
    public function getNavires(): Collection
    {
        return $this->navires;
    }

    public function addNavire(Navire $navire): static
    {
        if (!$this->navires->contains($navire)) {
            $this->navires->add($navire);
            $navire->setIdaisshiptype($this);
        }

        return $this;
    }

    public function removeNavire(Navire $navire): static
    {
        if ($this->navires->removeElement($navire)) {
            // set the owning side to null (unless already changed)
            if ($navire->getIdaisshiptype() === $this) {
                $navire->setIdaisshiptype(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Port>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Port $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->addType($this);
        }

        return $this;
    }

    public function removeType(Port $type): static
    {
        if ($this->types->removeElement($type)) {
            $type->removeType($this);
        }

        return $this;
    }


}
