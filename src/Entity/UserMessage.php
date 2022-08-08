<?php

namespace App\Entity;

use App\Repository\UserMessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMessageRepository::class)]
class UserMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $Content = null;

    #[ORM\ManyToOne(inversedBy: 'userMessages')]
    private ?User $UserMessage = null;

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

    public function getUserMessage(): ?User
    {
        return $this->UserMessage;
    }

    public function setUserMessage(?User $UserMessage): self
    {
        $this->UserMessage = $UserMessage;

        return $this;
    }
}