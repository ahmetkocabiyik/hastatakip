<?php

namespace App\Filament\Resources\Sgks;

use App\Filament\Resources\Sgks\Pages\CreateSgk;
use App\Filament\Resources\Sgks\Pages\EditSgk;
use App\Filament\Resources\Sgks\Pages\ListSgks;
use App\Filament\Resources\Sgks\Schemas\SgkForm;
use App\Filament\Resources\Sgks\Tables\SgksTable;
use App\Models\Sgk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class SgkResource extends Resource
{
    protected static ?string $model = Sgk::class;
    protected static ?string $modelLabel = "Sigorta Kaydı";
    protected static ?string $pluralModelLabel = "Sigorta Kayıtları";
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 5;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SgkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SgksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSgks::route('/'),
            'create' => CreateSgk::route('/create'),
            'edit' => EditSgk::route('/{record}/edit'),
        ];
    }
}
