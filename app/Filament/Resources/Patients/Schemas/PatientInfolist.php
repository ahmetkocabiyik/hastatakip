<?php

namespace App\Filament\Resources\Patients\Schemas;

use App\Models\Patient;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 2,
                    'sm' => 2,
                    'md' => 3,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('number')->label("Dosya No")->badge()->color("danger"),
                        TextEntry::make('name')->label("İsim Soyisim")->badge(),
                        TextEntry::make('id_no')->label("TC Kimlik No")->badge(),
                        TextEntry::make('registration_date')->label("Kayıt Tarihi")->badge()
                            ->date(),
                        TextEntry::make('birth_date')->label("Doğum Tarihi")->badge()
                            ->date(),
                        TextEntry::make('city.name')->label("Şehir")->badge(),
                        TextEntry::make('country.name')->label("Ülke")->badge(),
                        TextEntry::make('phone')->label("Telefon")->badge()
                            ->color("warning")
                            ->url(fn (Patient $record): string => $record->country->id === 1 ? 'https://wa.me/+90'.$record->phone: 'https://wa.me/'.$record->phone)
                            ->openUrlInNewTab(),
                        TextEntry::make('email')->badge()
                            ->label('Email Adresi'),
                        TextEntry::make('sgk.name')->label("Kurum")->badge(),
                        TextEntry::make('source')->label("İletişim")->badge(),
                        TextEntry::make('allergies')->badge()
                            ->label("Alerjiler"),
                        TextEntry::make('drugs')->badge()
                            ->label("Kullanılan İlaçlar"),
                        TextEntry::make('known_illness')->badge()
                            ->label("Bilinen Hastalıklar"),
                        TextEntry::make('past_operations')->badge()
                            ->label("Geçmiş Cerrahiler"),
                        TextEntry::make('complaint')->badge()
                            ->label("Şikayet"),
                    ])


            ]);
    }
}
