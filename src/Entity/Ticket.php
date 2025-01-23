<?php

namespace App\Entity;

use App\Enum\prioriteTicketEnum;
use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idTicket = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(enumType: prioriteTicketEnum::class)]
    private ?prioriteTicketEnum $priorite = null;

    #[ORM\Column(enumType: prioriteTicketEnum::class)]
    private ?prioriteTicketEnum $statut = null;

    #[ORM\ManyToOne(inversedBy: 'tickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idAuteur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTicket(): ?int
    {
        return $this->idTicket;
    }

    public function setIdTicket(int $idTicket): static
    {
        $this->idTicket = $idTicket;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPriorite(): ?prioriteTicketEnum
    {
        return $this->priorite;
    }

    public function setPriorite(prioriteTicketEnum $priorite): static
    {
        $this->priorite = $priorite;

        return $this;
    }

    public function getStatut(): ?prioriteTicketEnum
    {
        return $this->statut;
    }

    public function setStatut(prioriteTicketEnum $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdAuteur(): ?User
    {
        return $this->idAuteur;
    }

    public function setIdAuteur(?User $idAuteur): static
    {
        $this->idAuteur = $idAuteur;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
