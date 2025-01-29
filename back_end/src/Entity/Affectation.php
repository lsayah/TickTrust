<?php

namespace App\Entity;

use App\Enum\StatutAffectationEnum;
use App\Repository\AffectationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AffectationRepository::class)]
class Affectation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idAffectation = null;

    #[ORM\ManyToOne(inversedBy: 'affectations')]
    private ?Ticket $idTicket = null;

    #[ORM\ManyToOne(inversedBy: 'affectations')]
    private ?User $idUser = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAffectation = null;

    #[ORM\Column(enumType: StatutAffectationEnum::class)]
    private ?StatutAffectationEnum $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $resoluPar = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDeResolution = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAffectation(): ?int
    {
        return $this->idAffectation;
    }

    public function setIdAffectation(int $idAffectation): static
    {
        $this->idAffectation = $idAffectation;

        return $this;
    }

    public function getIdTicket(): ?Ticket
    {
        return $this->idTicket;
    }

    public function setIdTicket(?Ticket $idTicket): static
    {
        $this->idTicket = $idTicket;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getDateAffectation(): ?\DateTimeInterface
    {
        return $this->dateAffectation;
    }

    public function setDateAffectation(\DateTimeInterface $dateAffectation): static
    {
        $this->dateAffectation = $dateAffectation;

        return $this;
    }

    public function getStatut(): ?StatutAffectationEnum
    {
        return $this->statut;
    }

    public function setStatut(StatutAffectationEnum $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getResoluPar(): ?string
    {
        return $this->resoluPar;
    }

    public function setResoluPar(string $resoluPar): static
    {
        $this->resoluPar = $resoluPar;

        return $this;
    }

    public function getDateDeResolution(): ?\DateTimeInterface
    {
        return $this->dateDeResolution;
    }

    public function setDateDeResolution(\DateTimeInterface $dateDeResolution): static
    {
        $this->dateDeResolution = $dateDeResolution;

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
