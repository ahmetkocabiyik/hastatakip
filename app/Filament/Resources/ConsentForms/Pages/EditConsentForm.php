<?php

namespace App\Filament\Resources\ConsentForms\Pages;

use App\Filament\Resources\ConsentForms\ConsentFormResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConsentForm extends EditRecord
{
    protected static string $resource = ConsentFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
