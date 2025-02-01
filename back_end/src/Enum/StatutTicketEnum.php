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

    public function color(): string
    {
        return match ($this) {
            self::NOUVEAU => '#7F7F7F', // gris
            self::EN_COURS => '#61A5DA', // bleu
            self::RESOLU => '#28a745', // Vert
        };
    }

   
}
