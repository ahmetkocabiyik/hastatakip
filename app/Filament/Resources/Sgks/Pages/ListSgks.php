<?php

namespace App\Filament\Resources\Sgks\Pages;

use App\Filament\Resources\Sgks\SgkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSgks extends ListRecords
{
    protected static string $resource = SgkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
