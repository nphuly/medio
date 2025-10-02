<?php

namespace App\Filament\Resources\Doctors\Tables;

use App\Models\Doctors\Doctor;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class DoctorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable()
            ->columns([
                TextColumn::make('full_name')
                    ->label(__('medio.doctor.fields.full_name')),
                TextColumn::make(Doctor::GENDER)
                    ->formatStateUsing(fn ($state) => __('medio.settings.genders.' . $state))
                    ->label(__('medio.doctor.fields.gender')),
                TextColumn::make(Doctor::SPECIALITY)
                    ->label(__('medio.doctor.fields.speciality'))
                    ->formatStateUsing(fn ($state) => __('specialities.doctor.' . $state)),
                PhoneColumn::make('phones.phone_number')
                    ->label(__('medio.phones.fields.phone_number'))
                    ->limitList(1)
                    ->displayFormat(PhoneInputNumberType::INTERNATIONAL),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->modalWidth(Width::SixExtraLarge),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
