<?php

namespace App\Filament\Resources\Patients\Schemas;

use App\Enums\PatientGender;
use App\Enums\PatientSource;
use App\Enums\PatientStatus;
use App\Models\Patient;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->label("Dosya No")
                    ->default(fn () => Patient::query()->latest('id')->value('number')+1)
                    ->required(),
                TextInput::make('name')
                    ->label("İsim Soyisim")
                    ->required(),
                TextInput::make('id_no')
                    ->label("TC Kimlik / Pasaport No"),
                DatePicker::make('registration_date')
                    ->default(now())
                    ->label("Kayıt Tarihi"),
                DatePicker::make('birth_date')
                    ->default(now()->subYears(20))
                    ->label("Doğum Tarihi"),
                Select::make('city_id')
                    ->label("Şehir")
                    ->default(1)
                    ->relationship('city', 'name'),
                Select::make('country_id')
                    ->label("Ülke")
                    ->default(1)
                    ->required()
                    ->relationship('country', 'name'),
                TextInput::make('phone')
                    ->label("Telefon")
                    ->tel(),
                TextInput::make('email')
                    ->label('Email Adresi')
                    ->email(),
                Select::make('sgk_id')
                    ->label("Kurum")
                    ->default(1)
                    ->relationship('sgk', 'name'),

                Select::make('source')
                    ->label("İletişim")
                    ->options(PatientSource::class)
                    ->default(PatientSource::Phone)
                    ->required(),
                ToggleButtons::make('gender')
                    ->label("Cinsiyet")
                    ->default(PatientGender::Man)
                    ->inline()
                    ->options(PatientGender::class),
                Textarea::make('allergies')
                    ->label("Alerjiler"),
                Textarea::make('drugs')
                    ->label("Kullanılan İlaçlar"),
                Textarea::make('known_illness')
                    ->label("Bilinen Hastalıklar"),
                Textarea::make('past_operations')
                    ->label("Geçmiş Cerrahiler"),
                Textarea::make('complaint')
                    ->label("Şikayet")
                    ->columnSpanFull(),



            ]);
    }
}
