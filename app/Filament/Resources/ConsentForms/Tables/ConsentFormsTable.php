<?php

namespace App\Filament\Resources\ConsentForms\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ConsentFormsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label("Onam Formu Adı")
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('download')
                    ->label("Belgeyi İndir")
                    ->icon(Heroicon::ArrowDownTray)
                    ->color('success')
                    ->visible(fn ($record): bool => filled($record->document))
                    ->action(fn ($record) => Storage::disk('public')->download($record->document)),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
