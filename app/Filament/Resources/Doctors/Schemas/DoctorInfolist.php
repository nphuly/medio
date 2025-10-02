<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\Resources\Doctors\Schemas;

use App\Filament\GenericComponents\AddressesTabs;
use App\Filament\GenericComponents\PhonesRepeatableEntry;
use App\Models\Doctors\Doctor;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DoctorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make([
                        TextEntry::make(Doctor::FIRST_NAME)
                            ->label(__('medio.doctor.fields.first_name')),
                        TextEntry::make(Doctor::MIDDLE_NAME)
                            ->label(__('medio.doctor.fields.middle_name')),
                        TextEntry::make(Doctor::LAST_NAME)
                            ->label(__('medio.doctor.fields.last_name')),
                        TextEntry::make(Doctor::DOB)
                            ->label(__('medio.doctor.fields.dob')),
                        TextEntry::make(Doctor::EMAIL)
                            ->label(__('medio.doctor.fields.email')),
                        TextEntry::make(Doctor::GENDER)
                            ->label(__('medio.doctor.fields.gender'))
                            ->formatStateUsing(fn (string $state): string => __("medio.settings.genders.$state")),
                        TextEntry::make(Doctor::SPECIALITY)
                            ->label(__('medio.doctor.fields.speciality'))
                            ->formatStateUsing(fn (string $state): string => __('specialities.doctor.' . $state)),
                        TextEntry::make('work_schedule_array')
                            ->label(__('medio.doctor.fields.work_schedule'))
                            ->bulleted()
                    ])
                    ->columns(2)
                    ->label(__('medio.settings.labels.doctor_information')),
                ])->columnSpanFull(),
                PhonesRepeatableEntry::make(),
                AddressesTabs::make()
            ]);
    }
}
