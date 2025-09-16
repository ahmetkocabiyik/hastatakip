<?php

namespace App\Filament\Resources\Diagnoses\Pages;

use App\Filament\Resources\Diagnoses\DiagnosisResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDiagnosis extends ViewRecord
{
    protected static string $resource = DiagnosisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
