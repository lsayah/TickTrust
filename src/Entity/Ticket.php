<?php

namespace App\Entity;
use App\Entity\User;

use App\Enum\prioriteTicketEnum;
use App\Enum\StatutTicketEnum;
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
}
