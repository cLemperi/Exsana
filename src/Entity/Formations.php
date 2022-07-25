<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FormationsRepository::class)
 * @ORM\Table(name="formations", indexes={@ORM\Index(columns={"title"}, flags={"fulltext"})})
 * @UniqueEntity("title") 
 */
class Formations
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
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer", options={"default":"0"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer", options={"default":"0"})
     */
    private $duration;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $forWho;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prerequisite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFormation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $durationFormation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="Formations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=ObjectifFormation::class, mappedBy="objectifs", cascade={"persist"})
     */
    protected $objectifFormations;

    /**
     * @ORM\OneToMany(targetEntity=ProgrammeFormation::class, mappedBy="programme", cascade={"persist"})
     */
    private $programmeFormations;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->programmeFormations = new ArrayCollection();
        $this->objectifFormations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }


    public function getForWho(): ?string
    {
        return $this->forWho;
    }

    public function setForWho(?string $forWho): self
    {
        $this->forWho = $forWho;

        return $this;
    }

    public function getPrerequisite(): ?string
    {
        return $this->prerequisite;
    }

    public function setPrerequisite(?string $prerequisite): self
    {
        $this->prerequisite = $prerequisite;

        return $this;
    }

    public function getCreated_at(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreated_at(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDateFormation(): ?\DateTimeInterface
    {
        return $this->dateFormation;
    }

    public function setDateFormation(?\DateTimeInterface $dateFormation): self
    {
        $this->dateFormation = $dateFormation;

        return $this;
    }

    public function getDurationFormation(): ?int
    {
        return $this->durationFormation;
    }

    public function setDurationFormation(?int $durationFormation): self
    {
        $this->durationFormation = $durationFormation;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, ObjectifFormation>
     */
    public function getObjectifFormations(): Collection
    {
        return $this->objectifFormations;
    }

    public function addObjectifFormation(ObjectifFormation $objectifFormation): self
    {
        if (!$this->objectifFormations->contains($objectifFormation)) {
            $this->objectifFormations[] = $objectifFormation;
            $objectifFormation->setObjectifs($this);
        }

        return $this;
    }

    public function removeObjectifFormation(ObjectifFormation $objectifFormation): self
    {
        if ($this->objectifFormations->removeElement($objectifFormation)) {
            // set the owning side to null (unless already changed)
            if ($objectifFormation->getObjectifs() === $this) {
                $objectifFormation->setObjectifs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProgrammeFormation>
     */
    public function getProgrammeFormations(): Collection
    {
        return $this->programmeFormations;
    }

    public function addProgrammeFormation(ProgrammeFormation $programmeFormation): self
    {
        if (!$this->programmeFormations->contains($programmeFormation)) {
            $this->programmeFormations[] = $programmeFormation;
            $programmeFormation->setProgramme($this);
        }

        return $this;
    }

    public function removeProgrammeFormation(ProgrammeFormation $programmeFormation): self
    {
        if ($this->programmeFormations->removeElement($programmeFormation)) {
            // set the owning side to null (unless already changed)
            if ($programmeFormation->getProgramme() === $this) {
                $programmeFormation->setProgramme(null);
            }
        }

        return $this;
    }

}
