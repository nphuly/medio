<?php

namespace App\Filament\Resources\Patients\Tables;

use App\Models\Patients\Patient;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable()
            ->columns([
                TextColumn::make('full_name')
                    ->label(__('medio.patient.fields.full_name')),
                TextColumn::make(Patient::GENDER)
                    ->formatStateUsing(fn ($state) => __('medio.settings.genders.' . $state))
                    ->label(__('medio.patient.fields.gender')),
                TextColumn::make(Patient::DOB)
                    ->label(__('medio.patient.fields.dob')),
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
