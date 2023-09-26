<?php

namespace App\Entity;

use App\Repository\FormContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormContactRepository::class)]
class FormContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $sex = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Regex(pattern: '/\d/', match: false, message: 'Your name cannot contain a number')]
    private ?string $nickname = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Regex(pattern: '/\d/', match: false, message: 'Your name cannot contain a number')]
    private ?string $lastname = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Regex(
        pattern: "/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/",
        message: "Veuillez entrer un numéro de téléphone portable ou fixe français valide."
    )]
    private ?string $phone = null;


    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Email(message: "L'email '{{ value }}'n'est pas valide.")]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $etablissement = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Length(max: 100)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Length(max: 50)]
    private ?string $city = null;

    #[Assert\Regex('/^[0-9]{5}$/')]
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $postalCode = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $request = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $message = null;

    #[ORM\Column]
    private ?bool $isArchived = false;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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
    public function getProfession(): ?string
    {
        return $this->profession;
    }
    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }
    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }
    public function setEtablissement(?string $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }
    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }
    public function getRequest(): ?string
    {
        return $this->request;
    }
    public function setRequest(string $request): self
    {
        $this->request = $request;

        return $this;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }
    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }
}
