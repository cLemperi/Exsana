<?php

namespace App\Entity;

use App\Repository\ProgrammeFormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgrammeFormationRepository::class)
 */
class ProgrammeFormation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="programmeFormations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $programmes;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProgrammes(): ?Formations
    {
        return $this->programmes;
    }

    public function setProgrammes(?Formations $programmes): self
    {
        $this->programmes = $programmes;

        return $this;
    }
}
