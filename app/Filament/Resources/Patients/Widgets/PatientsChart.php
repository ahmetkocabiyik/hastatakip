<?php

namespace App\Filament\Resources\Patients\Widgets;

use App\Enums\PatientSource;
use App\Models\Patient;
use Carbon\CarbonInterface;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PatientsChart extends ChartWidget
{
    protected ?string $heading = 'Aylara Göre Yeni Hastalar';
    protected ?string $maxHeight = '200px';

    protected string $view = 'filament.widgets.patients-chart';

    public ?string $dateRange = '12months';

    /**
     * @return array<string, string>
     */
    public function getDateRangeOptions(): array
    {
        return [
            'all' => 'Tüm zamanlar',
            '24months' => 'Son 2 yıl',
            '12months' => 'Son 1 yıl',
            '6months' => 'Son 6 ay',
            'this_year' => 'Bu yıl',
            'last_year' => 'Geçen yıl',
        ];
    }

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
        [$start, $end] = $this->getDateRange();

        $query = Patient::query();

        if ($activeFilter = $this->filter) {
            $query->where('source', $activeFilter);
        }

        $data = Trend::query($query)
            ->between(
                start: $start,
                end: $end,
            )
            ->dateColumn('registration_date')
            ->perMonth()
            ->count();

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

    /**
     * @return array{0: CarbonInterface, 1: CarbonInterface}
     */
    protected function getDateRange(): array
    {
        $end = now()->endOfMonth();

        return match ($this->dateRange) {
            'all' => [
                Patient::min('registration_date')
                    ? \Illuminate\Support\Carbon::parse(Patient::min('registration_date'))->startOfMonth()
                    : now()->subMonths(11)->startOfMonth(),
                $end,
            ],
            '24months' => [now()->subMonths(23)->startOfMonth(), $end],
            '6months' => [now()->subMonths(5)->startOfMonth(), $end],
            'this_year' => [now()->startOfYear(), $end],
            'last_year' => [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()],
            default => [now()->subMonths(11)->startOfMonth(), $end],
        };
    }

    protected function getType(): string
    {
        return 'line';
    }
}
