<?php

namespace App\Filament\Resources\Sgks\Pages;

use App\Filament\Resources\Sgks\SgkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSgk extends EditRecord
{
    protected static string $resource = SgkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
