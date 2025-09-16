<?php

namespace App\Filament\Resources\Diagnoses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DiagnosisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('icd'),
            ]);
    }
}
