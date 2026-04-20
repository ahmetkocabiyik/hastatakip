<?php

namespace App\Filament\Resources\Patients\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'results';
    protected static ?string $modelLabel = "Hasta Sonucu";
    protected static ?string $pluralModelLabel = "Hasta Sonuçları";
    protected static ?string $title = "Hasta Sonuçları";

    public function form(Schema $schema): Schema
    {
        $patientNumber = $this->getOwnerRecord()->number;

        return $schema
            ->components([
                TextInput::make('name')
                    ->label("Ad")
                    ->required(),
                DatePicker::make('date')
                    ->label("Tarih")
                    ->required(),
                FileUpload::make('file')
                    ->label("Dosya")
                    ->deleteUploadedFileUsing(function ($file) {
                        Storage::disk('public')->delete($file);
                    })
                    ->directory("hasta-sonuclari/{$patientNumber}")
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label("Ad")
                    ->sortable(),
                TextColumn::make('date')
                    ->label("Tarih")
                    ->date()
                    ->sortable(),
                TextColumn::make('file')
                    ->label("Dosya")
                    ->limit(30)
                    ->url(fn ($record) => $record->file ? asset('uploads/' . $record->file) : null)
                    ->openUrlInNewTab(),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->after(function ($record) {
                        if ($record->file) {
                            Storage::disk('public')->delete($record->file);
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->after(function ($records) {
                            foreach ($records as $record) {
                                if ($record->file) {
                                    Storage::disk('public')->delete($record->file);
                                }
                            }
                        }),
                ]),
            ]);
    }
}
