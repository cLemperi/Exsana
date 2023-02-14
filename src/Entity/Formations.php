<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
#[ORM\Table(name: 'formations')]
#[ORM\Index(columns: ['title'], flags: ['fulltext'])]
#[UniqueEntity('title')]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $forWho = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $prerequisite = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTime|\DateTimeInterface|null $created_at = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $dateFormation = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $durationFormation = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'Formations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?\App\Entity\Category $category = null;

    #[ORM\OneToMany(targetEntity: ObjectifFormation::class, mappedBy: 'objectifs', cascade: ['persist'])]
    private \Doctrine\Common\Collections\Collection|array $objectifFormations;

    #[ORM\OneToMany(targetEntity: ProgrammeFormation::class, mappedBy: 'programme', cascade: ['persist'])]
    private \Doctrine\Common\Collections\Collection|array $programmeFormations;


    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $intervenant = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Evaluation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $publicAndAccessCondition = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'formations')]
    private Collection $users;
    
    
    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->programmeFormations = new ArrayCollection();
        $this->objectifFormations = new ArrayCollection();
        $this->users = new ArrayCollection();
    }
    public function __toString(): string
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
    public function getPrice(): ?string
    {
        return $this->price;
    }
    public function setPrice(string $price): self
    {
        $this->price = $price;

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
    public function getDateFormation(): string
    {
        return $this->dateFormation;
    }
    public function setDateFormation(?string $dateFormation): self
    {
        $this->dateFormation = $dateFormation;

        return $this;
    }
    public function getDurationFormation(): string
    {
        return $this->durationFormation;
    }
    public function setDurationFormation(?string $durationFormation): self
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
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }
    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }


    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getIntervenant(): ?string
    {
        return $this->intervenant;
    }

    public function setIntervenant(?string $intervenant): self
    {
        $this->intervenant = $intervenant;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->Evaluation;
    }

    public function setEvaluation(?string $Evaluation): self
    {
        $this->Evaluation = $Evaluation;

        return $this;
    }

    public function getPublicAndAccessCondition(): ?string
    {
        return $this->publicAndAccessCondition;
    }

    public function setPublicAndAccessCondition(?string $publicAndAccessCondition): self
    {
        $this->publicAndAccessCondition = $publicAndAccessCondition;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}
