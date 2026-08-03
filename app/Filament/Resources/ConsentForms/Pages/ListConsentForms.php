<?php

namespace App\Filament\Resources\ConsentForms\Pages;

use App\Filament\Resources\ConsentForms\ConsentFormResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConsentForms extends ListRecords
{
    protected static string $resource = ConsentFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
