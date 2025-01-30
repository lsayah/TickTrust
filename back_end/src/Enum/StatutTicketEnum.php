<?php

namespace App\Enum;

enum StatutTicketEnum: int
{
    case NOUVEAU = 0;
    case EN_COURS = 1;
    case RESOLU = 2;

    public function toString(): string
    {
        return match ($this) {
            self::NOUVEAU => 'Nouveau',
            self::EN_COURS => 'En cours',
            self::RESOLU => 'Résolu',
        };
    }

   
}
