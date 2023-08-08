<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il y a deja un utilisateur avec cette email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $username = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $password = null;

    /**
     * @var string[]
     * @psalm-var list<string>
     */
    #[ORM\Column(type: 'json')]
    private ?array $roles = [];

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $sex = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $job = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $rppsCode = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $street = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $profil = null;

    /**
     * @var Collection|UserMessage[]
     * @psalm-var Collection<int, UserMessage>
     */
    #[ORM\OneToMany(targetEntity: UserMessage::class, mappedBy: 'UserMessage', cascade: ['persist'])]
    private \Doctrine\Common\Collections\Collection $UserMessages;

    /**
     * @var Collection|UserInvite[]
     * @psalm-var Collection<int, UserInvite>
     */
    #[ORM\OneToMany(mappedBy: 'UserFrom', targetEntity: UserInvite::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $userInvites;

    #[ORM\Column(nullable: true)]
    private ?int $nbUserInvite = null;

    /**
     * @var Collection|Formations[]
     * @psalm-var Collection<int, Formations>
     */
    #[ORM\ManyToMany(targetEntity: Formations::class, mappedBy: 'users')]
    private Collection $formations;

    /**
     * @var Collection|FormationUser[]
     * @psalm-var Collection<int, FormationUser>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: FormationUser::class)]
    private Collection $formationUsers;

    /**
     * @var Collection|Participant[]
     * @psalm-var Collection<int, Participant>
     */
    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: Participant::class, cascade: ['persist'])]
    private Collection $participants;

    public function __construct()
    {
        $this->UserMessages = new ArrayCollection();
        //$this->formationregisterid = new ArrayCollection();
        $this->userInvites = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->formationUsers = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->email ? $this->email : "";
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    /**
     * @param string[] $roles
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    public function getSex(): ?string
    {
        return $this->sex;
    }
    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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
    public function getJob(): ?string
    {
        return $this->job;
    }
    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
    public function getRppsCode(): ?string
    {
        return $this->rppsCode;
    }
    public function setRppsCode(?string $rppsCode): self
    {
        $this->rppsCode = $rppsCode;

        return $this;
    }
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }
    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }
    public function getStreet(): ?string
    {
        return $this->street;
    }
    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }
    public function getProfil(): ?string
    {
        return $this->profil;
    }
    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * @return Collection|UserMessage
     * @psalm-return Collection<int, UserMessage>
     */
    public function getUserMessage(): \Doctrine\Common\Collections\Collection
    {
        return $this->UserMessages;
    }
    public function addUserMessage(UserMessage $UserMessage): self
    {
        if (!$this->UserMessages->contains($UserMessage)) {
            $this->UserMessages[] = $UserMessage;
            $UserMessage->setUserMessage($this);
        }

        return $this;
    }
    public function removeUserMessage(UserMessage $UserMessage): self
    {
        if ($this->UserMessages->removeElement($UserMessage)) {
            // set the owning side to null (unless already changed)
            if ($UserMessage->getUserMessage() === $this) {
                $UserMessage->setUserMessage(null);
            }
        }

        return $this;
    }
    public function getSalt(): ?string
    {
        return null;
    }
    public function eraseCredentials(): void
    {
    }
    /**
     * Controls how the object is represented during PHP serialization.
     *
     * Used by PHP >= 7.4.
     *
     * @return array<string, mixed> The properties of the object as an associative array.
     */
    public function __serialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function setData(array $data): void
    {
        if (isset($data['id']) && is_int($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['username']) && is_string($data['username'])) {
            $this->username = $data['username'];
        }
        if (isset($data['password']) && is_string($data['password'])) {
            $this->password = $data['password'];
        }
    }


    /**
     * Controls how the object is reconstructed from a PHP serialized representation.
     *
     * Used by PHP >= 7.4.
     *
     * @param array <string, mixed> $data The associative array representation of the object.
     */
    public function __unserialize(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function serialize(): string
    {
        return  serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }
    public function unserialize($serialized): void
    {
        $data = unserialize($serialized, ['allowed_classes' => false]);
        if (is_array($data) && count($data) === 3) {
            $this->id = (int) $data[0];
            $this->username = (string) $data[1];
            $this->password = (string) $data[2];
        }
    }

    /**
     * Returns the identifier for this user (e.g. its username or email address).
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }



    /**
     * @return Collection|UserInvite
     * @psalm-return Collection<int, UserInvite>
     */
    public function getUserInvites(): Collection
    {
        return $this->userInvites;
    }

    public function addUserInvite(UserInvite $userInvite): self
    {
        if (!$this->userInvites->contains($userInvite)) {
            $this->userInvites[] = $userInvite;
            $userInvite->setUserFrom($this);
        }

        return $this;
    }

    public function removeUserInvite(UserInvite $userInvite): self
    {
        if ($this->userInvites->removeElement($userInvite)) {
            // set the owning side to null (unless already changed)
            if ($userInvite->getUserFrom() === $this) {
                $userInvite->setUserFrom(null);
            }
        }

        return $this;
    }

    public function getNbUserInvite(): ?int
    {
        return $this->nbUserInvite;
    }

    public function setNbUserInvite(?int $nbUserInvite): self
    {
        $this->nbUserInvite = $nbUserInvite;

        return $this;
    }

    /**
     * @return Collection|Formations
     * @psalm-return Collection<int, Formations>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formations $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->addUser($this);
        }

        return $this;
    }

    public function removeFormation(Formations $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|FormationUser
     * @psalm-return Collection<int, FormationUser>
     */
    public function getFormationUsers(): Collection
    {
        return $this->formationUsers;
    }

    public function addFormationUser(FormationUser $formationUser): self
    {
        if (!$this->formationUsers->contains($formationUser)) {
            $this->formationUsers[] = $formationUser;
            $formationUser->setUser($this);
        }

        return $this;
    }

    public function removeFormationUser(FormationUser $formationUser): self
    {
        if ($this->formationUsers->removeElement($formationUser)) {
            // set the owning side to null (unless already changed)
            if ($formationUser->getUser() === $this) {
                $formationUser->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participant
     * @psalm-return Collection<int, Participant>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setRelation($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getRelation() === $this) {
                $participant->setRelation(null);
            }
        }

        return $this;
    }
}
