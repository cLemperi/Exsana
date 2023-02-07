<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ObjectifFormationRepository;

#[ORM\Entity(repositoryClass: ObjectifFormationRepository::class)]
class ObjectifFormation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Formations::class, inversedBy: 'objectifFormations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: "objForma_id" ,referencedColumnName: "id" ,nullable: false)]
    private ?\App\Entity\Formations $objectifs = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;
    
    public function __toString(): string
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getObjectifs(): ?Formations
    {
        return $this->objectifs;
    }
    public function setObjectifs(?Formations $objectifs): self
    {
        $this->objectifs = $objectifs;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
