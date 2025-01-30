<?php
// src/Enum/RoleEnum.php
namespace App\Enum;

enum ServiceEnum: string
{
    case FINANCIER = 'Financier';
    case IT = 'IT';
    case NONE = 'NONE';
 

    // Optionnellement, tu peux ajouter des méthodes pour l'affichage ou d'autres fonctionnalités
    public function label(): string
    {
        return match ($this) {
            self::FINANCIER => 'Financier',
            self::IT => 'IT',
            self::NONE => 'NONE',
            
        };
    }
}
