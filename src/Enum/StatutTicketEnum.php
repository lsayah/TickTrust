<?php
// src/Enum/StatutTicketEnum.php
namespace App\Enum;

enum StatutTicketEnum: string
{
    case EN_ATTENTE = 'en_attente';
    case EN_COURS = 'en_cours';
    case TERMINE = 'terminé';
    case ANNULE = 'annulé';

    // Optionnellement, tu peux ajouter des méthodes pour des labels lisibles
    public function label(): string
    {
        return match ($this) {
            self::EN_ATTENTE => 'En attente',
            self::EN_COURS => 'En cours',
            self::TERMINE => 'Terminé',
            self::ANNULE => 'Annulé',
        };
    }
}
