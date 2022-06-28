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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="objectifFormations",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $objectifs;

    public function __toString()
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
}
