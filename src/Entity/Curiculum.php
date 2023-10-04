<?php

namespace App\Entity;

use App\Repository\CuriculumRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: CuriculumRepository::class)]
class Curiculum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre ne peut pas être vide.")]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: "Le titre doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le titre ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $titre = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime|\DateTimeInterface|null $created_at = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom du fichier CV est obligatoire.")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom du fichier CV ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $curiculumFile = null;


    #[Assert\NotBlank(message: "Le prénom ne peut pas être vide.")]
    #[Assert\Regex(
        pattern : "/^[a-zA-Zàáâäçèéêëìíîïòóôöùúûüýÿ\s-]+$/",
        message : "Le prénom ne peut contenir que des lettres, des espaces et des tirets."
    )]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: "Le prénom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le prénom ne peut pas contenir plus de {{ limit }} caractères."
    )]
    #[ORM\Column(length: 255)]
    private ?string $Firstname = null;

    #[Assert\NotBlank(message: "Le nom ne peut pas être vide.")]
    #[Assert\Regex(
        pattern : "/^[a-zA-Zàáâäçèéêëìíîïòóôöùúûüýÿ\s-]+$/",
        message : "Le nom ne peut contenir que des lettres, des espaces et des tirets."
    )]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom ne peut pas contenir plus de {{ limit }} caractères."
    )]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        max: 3000,
        maxMessage: "Le message ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $message = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCuriculumFile(): ?string
    {
        return $this->curiculumFile;
    }

    public function setCuriculumFile(string $curiculumFile): self
    {
        $this->curiculumFile = $curiculumFile;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
