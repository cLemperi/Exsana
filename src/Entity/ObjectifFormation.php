<?php

namespace App\Entity;

use App\Repository\ObjectifFormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjectifFormationRepository::class)
 */
class ObjectifFormation
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
    private $Description;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="objectifFormations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objectifs;

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
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

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
}
