<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PatientStatus : string implements HasLabel,HasColor,HasIcon
{
    case New = "new-patient";
    case Existing = "existing-patient";




    public function getLabel(): ?string
    {
        return match($this) {
            self::New => "Yeni Hasta",
            self::Existing => "Mevcut Hasta",

        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::New => 'heroicon-o-user',
            self::Existing => 'heroicon-o-user',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::New => 'success',
            self::Existing => 'success',
        };
    }
}
