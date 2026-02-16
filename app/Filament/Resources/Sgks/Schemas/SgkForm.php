<?php

namespace App\Filament\Resources\Sgks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SgkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->label("Sigorta Adı")
                    ->rules(['required'])
                    ->validationMessages([
                        'required' => 'Sigorta adı zorunludur.',
                    ])

            ]);
    }
}
