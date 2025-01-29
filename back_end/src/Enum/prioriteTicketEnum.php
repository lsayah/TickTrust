<?php

namespace App\Enum;

enum PrioriteTicketEnum: int
{
    case BASSE = 0;
    case NORMALE = 1;
    case HAUTE = 2;

    public function toString(): string
    {
        return match ($this) {
            self::BASSE => 'Basse priorité',
            self::NORMALE => 'Priorité normale',
            self::HAUTE => 'Haute priorité',
        };
    }


    // Optionnellement, tu peux ajouter une méthode pour récupérer l'intensité de la priorité
    public function getIntensity(): int
    {
        return $this->value;
    }
}
