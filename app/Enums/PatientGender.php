<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PatientGender : string implements HasLabel,HasColor,HasIcon
{
    case Man = "man";
    case Woman = "woman";




    public function getLabel(): ?string
    {
        return match($this) {
            self::Man => "Erkek",
            self::Woman => "Bayan",

        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Man => 'heroicon-o-user',
            self::Woman => 'heroicon-o-user',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Man => 'success',
            self::Woman => 'warning',
        };
    }
}
