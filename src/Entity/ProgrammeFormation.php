<?php

namespace App\Entity;

use App\Repository\ProgrammeFormationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammeFormationRepository::class)]
class ProgrammeFormation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Formations::class, inversedBy: 'programmeFormations', cascade: ['persist'])]
    #[ORM\JoinColumn(name: "proForma_id" ,referencedColumnName: "id",nullable: false)]
    private ?\App\Entity\Formations $programme = null;

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
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    public function getProgramme(): ?Formations
    {
        return $this->programme;
    }
    public function setProgramme(?Formations $programme): self
    {
        $this->programme = $programme;

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
