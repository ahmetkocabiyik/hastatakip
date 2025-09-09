<?php

namespace App\Filament\Resources\Patients\Tables;

use App\Enums\PatientSource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder\Constraints\RelationshipConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\RelationshipConstraint\Operators\IsRelatedToOperator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('number', 'desc')
            ->defaultPaginationPageOption(50)
            ->columns([
                TextColumn::make('number')
                    ->label("Dosya No")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->sortable()
                    ->label("İsim Soyisim")
                    ->searchable(),
                TextColumn::make('registration_date')
                    ->sortable()
                    ->label("Kayıt Tarihi")
                    ->sortable()
                    ->date(),
                TextColumn::make('id_no')
                    ->label("TC Kimlik")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                TextColumn::make('city.name')
                    ->sortable()
                    ->label("Şehir")
                    ->searchable(),
                TextColumn::make('country.name')
                    ->sortable()
                    ->label("Ülke")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('phone')
                    ->label("Telefon")
                    ->searchable(),

                TextColumn::make('sgk.name')
                    ->label("Kurum")
                    ->sortable()
                    ->searchable(),

                TextColumn::make('source')
                    ->sortable()
                    ->label("İletişim")
                    ->badge()
                    ->searchable(),


            ])
            ->filters([
                //
                SelectFilter::make('diagnoses')
                    ->label("Tanı")
                    ->relationship('diagnoses', 'name'),
                SelectFilter::make('transactions')
                    ->label("İşlem")
                    ->relationship('transactions', 'name'),
                SelectFilter::make("source")
                    ->label("İletişim")
                    ->options(PatientSource::class),
                Filter::make('registration_date')
                    ->schema([

                        Select::make('registration_month')
                            ->label('Ay')
                            ->options([
                                1 => 'Ocak', 2 => 'Şubat', 3 => 'Mart', 4 => 'Nisan', 5 => 'Mayıs', 6 => 'Haziran',
                                7 => 'Temmuz', 8 => 'Ağustos', 9 => 'Eylül', 10 => 'Ekim', 11 => 'Kasım', 12 => 'Aralık',
                            ])
                            ->placeholder('Ay seçin'),

                        Select::make('registration_year')
                            ->label('Yıl')
                            ->default(now()->year)
                            ->options(collect(range(now()->year, now()->year - 10))->sort()->mapWithKeys(fn ($y) => [$y => (string) $y])->all())
                            ->placeholder('Yıl seçin'),



                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['registration_month'] ?? null,
                                function (Builder $query, $month) use ($data): Builder {
                                    $year = $data['registration_year'] ?? now()->year;
                                    return $query
                                        ->whereMonth('registration_date', (int) $month)
                                        ->whereYear('registration_date', (int) $year);
                                }
                            );

                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['registration_month']) {
                            return null;
                        }
                        $month = match (intval($data['registration_month'])) {
                            1 => 'Ocak', 2 => 'Şubat', 3 => 'Mart', 4 => 'Nisan', 5 => 'Mayıs', 6 => 'Haziran',
                            7 => 'Temmuz', 8 => 'Ağustos', 9 => 'Eylül', 10 => 'Ekim', 11 => 'Kasım', 12 => 'Aralık',
                        };

                        return 'Tarih : ' . $month." ".$data['registration_year'];
                    })
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
