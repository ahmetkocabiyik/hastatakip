<?php

namespace App\Filament\Resources\Patients\Pages;

use App\Filament\Resources\Patients\PatientResource;
use App\Models\Diagnosis;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Icons\Heroicon;

class ViewPatient extends ViewRecord
{
    protected static string $resource = PatientResource::class;


    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ActionGroup::make([
                Action::make('durumBildirirRaporu')
                    ->label('Durum Bildirir Raporu')
                    ->icon(Heroicon::DocumentText)
                    ->modalHeading('Durum Bildirir Raporu')
                    ->modalSubmitActionLabel('Rapor Oluştur')
                    ->schema([
                        Select::make('diagnosis_id')
                            ->label('Tanı')
                            ->options(fn (): array => $this->getRecord()->diagnoses->pluck('name', 'id')->all())
                            ->multiple()
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set): void {
                                $codes = Diagnosis::whereIn('id', (array) $state)
                                    ->pluck('icd')
                                    ->filter()
                                    ->implode(', ');

                                $set('tani_kodu', $codes);
                            }),
                        TextInput::make('tani_kodu')
                            ->label('Tanı Kodu'),
                        Select::make('islem')
                            ->label('İşlem')
                            ->options(fn (): array => $this->getRecord()->transactions->pluck('name', 'name')->all())
                            ->multiple()
                            ->searchable(),
                        TextInput::make('istirahat_gun')
                            ->label('İstirahat (gün)')
                            ->numeric()
                            ->minValue(0),
                    ])
                    ->action(function (array $data, $livewire): void {
                        $tani = ! empty($data['diagnosis_id'])
                            ? Diagnosis::whereIn('id', $data['diagnosis_id'])->pluck('name')->implode(', ')
                            : null;

                        $url = route('patients.reports.durum-bildirir', [
                            'patient' => $this->getRecord(),
                            'tani' => $tani,
                            'tani_kodu' => $data['tani_kodu'] ?? null,
                            'islem' => ! empty($data['islem']) ? implode(', ', $data['islem']) : null,
                            'istirahat_gun' => $data['istirahat_gun'] ?? null,
                        ]);

                        $livewire->js('window.open(' . json_encode($url) . ", '_blank')");
                    }),
            ])
                ->label('Raporlar')
                ->icon(Heroicon::DocumentArrowDown)
                ->button(),
        ];
    }
}
