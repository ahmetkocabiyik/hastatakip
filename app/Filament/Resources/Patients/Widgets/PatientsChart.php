<?php

namespace App\Filament\Resources\Patients\Widgets;

use App\Enums\PatientSource;
use App\Models\Patient;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PatientsChart extends ChartWidget
{
    protected ?string $heading = 'Aylara Göre Yeni Hastalar';
    protected ?string $maxHeight = '200px';

    protected function getFilters(): ?array
    {
        return array_merge(
            ['' => 'Tümü'],
            collect(PatientSource::cases())
                ->mapWithKeys(fn (PatientSource $source) => [
                    $source->value => $source->getLabel(),
                ])
                ->toArray()
        );


    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        if($activeFilter) {
            $data = Trend::query(
                Patient::query()->where("source", $activeFilter))
                ->between(
                    start: now()->subYear(),
                    end: now(),
                )
                ->dateColumn("registration_date")
                ->perMonth()
                ->count();
        }
        else {
            $data = Trend::model(Patient::class)
                ->between(
                    start: now()->subYear(),
                    end: now(),
                )
                ->dateColumn("registration_date")
                ->perMonth()
                ->count();
        }


        return [
            'datasets' => [
                [
                    'label' => 'Yeni Hasta',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
