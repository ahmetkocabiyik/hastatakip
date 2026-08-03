<?php

namespace App\Filament\Resources\ConsentForms;

use App\Filament\Resources\ConsentForms\Pages\CreateConsentForm;
use App\Filament\Resources\ConsentForms\Pages\EditConsentForm;
use App\Filament\Resources\ConsentForms\Pages\ListConsentForms;
use App\Filament\Resources\ConsentForms\Schemas\ConsentFormForm;
use App\Filament\Resources\ConsentForms\Tables\ConsentFormsTable;
use App\Models\ConsentForm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConsentFormResource extends Resource
{
    protected static ?string $model = ConsentForm::class;
    protected static ?string $modelLabel = "Onam Formu";
    protected static ?string $pluralModelLabel = "Onam Formları";
    protected static ?int $navigationSort = 8;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ConsentFormForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConsentFormsTable::configure($table);
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
            'index' => ListConsentForms::route('/'),
            'create' => CreateConsentForm::route('/create'),
            'edit' => EditConsentForm::route('/{record}/edit'),
        ];
    }
}
