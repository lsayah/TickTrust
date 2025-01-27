<?php

namespace App\Enum;

enum StatutAffectationEnum: string
{
    case ASSIGNE = 'assigné';
    case REAFFECTE = 'réaffecté';
    case TERMINE = 'terminé';
    case EN_COURS = 'en cours';
    case NON_RESOLU = 'non résolu';

    public function label(): string
    {
        return match ($this) {
            self::ASSIGNE => 'Affectation assignée',
            self::REAFFECTE => 'Affectation réaffectée',
            self::TERMINE => 'Affectation terminée',
            self::EN_COURS => 'Affectation en cours',
            self::NON_RESOLU => 'Affectation non résolue',
        };
    }
}
