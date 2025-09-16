<?php

namespace App\Filament\Resources\Hospitals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HospitalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->label("Hastane Adı")
            ]);
    }
}
