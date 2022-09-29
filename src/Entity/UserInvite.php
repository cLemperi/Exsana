<?php

namespace App\Entity;

use App\Repository\UserInviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserInviteRepository::class)]
class UserInvite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nickname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\ManyToOne(targetEntity: User::class,inversedBy: 'userInvites',cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $UserFrom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: Formations::class)]
    private Collection $formationregistration;

    public function __construct()
    {
        $this->formationregistration = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getUserFrom(): ?User
    {
        return $this->UserFrom;
    }

    public function setUserFrom(?User $UserFrom): self
    {
        $this->UserFrom = $UserFrom;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Formations>
     */
    public function getFormationregistration(): Collection
    {
        return $this->formationregistration;
    }

    public function addFormationregistration(Formations $formationregistration): self
    {
        if (!$this->formationregistration->contains($formationregistration)) {
            $this->formationregistration[] = $formationregistration;
        }

        return $this;
    }

    public function removeFormationregistration(Formations $formationregistration): self
    {
        $this->formationregistration->removeElement($formationregistration);

        return $this;
    }
}
