<?php

namespace App\Filament\Exports;

use App\Enums\LeadSource;
use App\Enums\PatientGender;
use App\Enums\PatientSource;
use App\Models\Patient;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PatientExporter extends Exporter
{
    protected static ?string $model = Patient::class;

    public static function getColumns(): array
    {
        return [

            ExportColumn::make('number')->label("Dosya No"),
            ExportColumn::make('name')->label("İsim Soyisim"),
            ExportColumn::make('gender')->formatStateUsing(function (PatientGender $state): string {
                return str($state->getLabel());
            })->label("Cinsiyet"),
            ExportColumn::make('id_no')->label("TC Kimlik/Pasaport No"),
            ExportColumn::make('birth_date')->label("Doğum Tarihi"),
            ExportColumn::make('registration_date')->label("Kayıt Tarihi"),
            ExportColumn::make('city.name')->label("Şehir"),
            ExportColumn::make('country.name')->label("Ülke"),
            ExportColumn::make('phone')->label("Telefon"),
            ExportColumn::make('email')->label("E-Posta"),
            ExportColumn::make('sgk.name')->label("Kurum"),
            ExportColumn::make('source')->formatStateUsing(function (PatientSource $state): string {
                return str($state->getLabel());
            })->label("İletişim"),

            ExportColumn::make('diagnoses.name')->label("Tanılar"),
            ExportColumn::make('transactions.name')->label("İşlemler"),
            ExportColumn::make('allergies')->label("Allerjiler"),
            ExportColumn::make('drugs')->label("Kullandığı İlaçlar"),
            ExportColumn::make('past_operations')->label("Geçmiş Operasyonlar"),
            ExportColumn::make('known_illness')->label("Bilinen Hastalıklar"),
            ExportColumn::make('complaint')->label("Şikayet"),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Hasta dışarı aktarma işlemi başarıyla tamamlandı. ' . Number::format($export->successful_rows) . ' satır dışa aktarıldı.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
