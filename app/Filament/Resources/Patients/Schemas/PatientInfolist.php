<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\Resources\Patients\Schemas;


use App\Filament\GenericComponents\AddressesTabs;
use App\Filament\GenericComponents\PhonesRepeatableEntry;
use App\Models\Patients\Patient;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PatientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make([
                        TextEntry::make(Patient::FIRST_NAME)
                            ->label(__('medio.patient.fields.first_name')),
                        TextEntry::make(Patient::MIDDLE_NAME)
                            ->label(__('medio.patient.fields.middle_name')),
                        TextEntry::make(Patient::LAST_NAME)
                            ->label(__('medio.patient.fields.last_name')),
                        TextEntry::make(Patient::DOB)
                            ->label(__('medio.patient.fields.dob')),
                        TextEntry::make(Patient::EMAIL)
                            ->label(__('medio.patient.fields.email')),
                        TextEntry::make(Patient::GENDER)
                            ->label(__('medio.patient.fields.gender'))
                            ->formatStateUsing(fn (string $state): string => __("medio.settings.genders.$state")),
                    ])
                    ->columns(2)
                    ->label(__('medio.settings.labels.patient_information')),
                ])->columnSpanFull(),
                PhonesRepeatableEntry::make()
                    ->placeholder(__('medio.settings.no_information'))
                    ->label(__('medio.phones.translation_plural')),
                RepeatableEntry::make('backgroundConditions')
                    ->placeholder(__('medio.settings.no_information'))
                    ->table([
                        RepeatableEntry\TableColumn::make(__('medio.patient.fields.background_condition')),
                        RepeatableEntry\TableColumn::make(__('medio.patient.fields.background_condition_note')),
                    ])
                    ->schema([
                        TextEntry::make('medicalCondition.name'),
                        TextEntry::make('medicalCondition.notes')
                            ->placeholder(__('medio.settings.no_information')),
                    ])
                    ->label(__('medio.patient.fields.medical_history'))
                    ->columnSpanFull(),
                AddressesTabs::make()
            ]);
    }
}
