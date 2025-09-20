<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use App\Models\Hospital;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';
    protected static ?string $title = 'İşlemler';
    protected static ?string $modelLabel = "İşlem";
    protected static ?string $pluralModelLabel = "İşlemler";

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')->label("İşlem Tarihi")->default(now()),
                Select::make("hospital_id")->options(Hospital::all()->pluck('name', 'id'))->label("Hastane"),
                Textarea::make("note")->label("İşlem Notu"),
                Textarea::make("special_material")->label("Özellikli Malzeme"),
                Toggle::make("has_laser")->label("Lazer kullanıldı mı ?"),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')

            ->columns([
                TextColumn::make('name')
                    ->label("İşlem Adı")
                    ->searchable(),
                TextColumn::make('date')
                    ->label("Tarih"),
                TextColumn::make('hospital.name')
                    ->label("Hastane"),
                IconColumn::make('has_laser')
                    ->label("Lazer Kullanımı")
                    ->boolean(),
                TextColumn::make('special_material')
                    ->label("Özellikli Malzeme"),
                TextColumn::make('note')
                    ->label("Not"),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->schema(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        DatePicker::make('date')->label("İşlem Tarihi")->default(now()),
                        Select::make("hospital_id")->options(Hospital::all()->pluck('name', 'id'))->label("Hastane"),
                        Textarea::make("note")->label("İşlem Notu"),
                        Textarea::make("special_material")->label("Özellikli Malzeme"),
                        Toggle::make("has_laser")->label("Lazer kullanıldı mı ?"),
                    ])
                    ->color('primary')->preloadRecordSelect(),


            ])
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
