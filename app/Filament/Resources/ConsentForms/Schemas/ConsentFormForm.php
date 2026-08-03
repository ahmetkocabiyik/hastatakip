<?php

namespace App\Filament\Resources\ConsentForms\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ConsentFormForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label("Onam Formu Adı")
                    ->rules(['required'])
                    ->columnSpanFull()
                    ->validationMessages([
                        'required' => 'Onam formu adı zorunludur.',
                    ]),
                FileUpload::make('document')
                    ->label("Onam Formu Belgesi")
                    ->disk('public')
                    ->columnSpanFull()
                    ->directory('consent-forms')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                    ->downloadable()
                    ->openable(),
            ]);
    }
}
