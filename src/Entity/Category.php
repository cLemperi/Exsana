<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Formations::class, mappedBy: 'category', orphanRemoval: true)]
    private \Doctrine\Common\Collections\Collection|array $Formations;
    
    public function __construct()
    {
        $this->Formations = new ArrayCollection();
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
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    /**
     * @return Collection|Formations[]
     */
    public function getFormations(): Collection
    {
        return $this->Formations;
    }
    public function addFormation(Formations $formation): self
    {
        if (!$this->Formations->contains($formation)) {
            $this->Formations[] = $formation;
            $formation->setCategory($this);
        }

        return $this;
    }
    public function removeFormation(Formations $formation): self
    {
        if ($this->Formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getCategory() === $this) {
                $formation->setCategory(null);
            }
        }

        return $this;
    }
}
