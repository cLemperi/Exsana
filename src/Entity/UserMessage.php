<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserMessageRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserMessageRepository::class)]
class UserMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Le titre ne peut pas être vide.")]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\NotBlank(message: "Le message ne peut pas être vide.")]
    #[ORM\Column(length: 500)]
    private ?string $Content = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'UserMessages', cascade: ['persist'])]
    #[ORM\JoinColumn(name: "user_message_id", referencedColumnName: "id")]
    private ?UserInterface $UserMessage = null;

    #[ORM\Column]
    private ?bool $isArchived = false;

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

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getUserMessage(): ?UserInterface
    {
        return $this->UserMessage;
    }

    public function setUserMessage(?UserInterface $UserMessage): self
    {
        $this->UserMessage = $UserMessage;

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
