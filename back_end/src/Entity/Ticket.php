<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TicketRepository;
use App\Enum\PrioriteTicketEnum;
use App\Enum\StatutTicketEnum;
use App\Enum\ServiceEnum;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $category = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: 'integer')]
    private ?int $priorite = null;

    #[ORM\Column(type: 'integer')]
    private ?int $statut = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idAuteur = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $attachment = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $service = null;

    public function __construct()
    {
        $this->priorite = PrioriteTicketEnum::NORMALE->value;
        $this->statut = StatutTicketEnum::NOUVEAU->value;
        $this->service = ServiceEnum::NONE->value;
    }

    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

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

    public function getPriorite(): ?PrioriteTicketEnum
    {
        return PrioriteTicketEnum::from($this->priorite);
    }

    public function setPriorite(PrioriteTicketEnum $priorite): static
    {
        $this->priorite = $priorite->value;

        return $this;
    }

    public function getStatut(): ?StatutTicketEnum
    {
        return StatutTicketEnum::from($this->statut);
    }

    public function setStatut(StatutTicketEnum $statut): static
    {
        $this->statut = $statut->value;

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

    public function getAttachment(): ?string
    {
        return $this->attachment;
    }

    public function setAttachment(?string $attachment): static
    {
        $this->attachment = $attachment;

        return $this;
    }

    public function getService(): ?ServiceEnum
    {
        return ServiceEnum::from($this->service);
    }

    public function setService(ServiceEnum $service): static
    {
        $this->service = $service->value;

        return $this;
    }


     /**
     * @return Collection<int, Affectation>
     */
    public function getAffectations(): Collection
    {
        return $this->affectations;
    }

    public function addAffectation(Affectation $affectation): static
    {
        if (!$this->affectations->contains($affectation)) {
            $this->affectations->add($affectation);
            $affectation->setIdTicket($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): static
    {
        if ($this->affectations->removeElement($affectation)) {
            // set the owning side to null (unless already changed)
            if ($affectation->getIdTicket() === $this) {
                $affectation->setIdTicket(null);
            }
        }

        return $this;
    }
}