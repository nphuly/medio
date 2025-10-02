<?php

namespace App\Filament\Resources\Patients\Schemas;

use App\Filament\GenericComponents\ContactForm;
use App\Models\Patients\Patient;
use App\Models\Settings\MedicalCondition;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        $components = [
            TextInput::make(Patient::FIRST_NAME)
                ->label(__('medio.patient.fields.first_name'))
                ->required(),
            TextInput::make(Patient::MIDDLE_NAME)
                ->label(__('medio.patient.fields.middle_name')),
            TextInput::make(Patient::LAST_NAME)
                ->label(__('medio.patient.fields.last_name'))
                ->required(),
            TextInput::make(Patient::EMAIL)
                ->label(__('medio.patient.fields.email'))
                ->email(),
            DatePicker::make(Patient::DOB)
                ->label(__('medio.patient.fields.dob'))
                ->native(false)
                ->required(),
            Select::make(Patient::GENDER)
                ->label(__('medio.patient.fields.gender'))
                ->native(false)
                ->options([
                    'male' => __('medio.settings.genders.male'),
                    'female' => __('medio.settings.genders.female'),
                    'other' => __('medio.settings.genders.other'),
                ])
                ->required(),
            Repeater::make('backgroundConditions')
                ->label(__('medio.patient.fields.medical_history'))
                ->relationship()
                ->table([
                    Repeater\TableColumn::make(__('medio.patient.fields.background_condition')),
                    Repeater\TableColumn::make(__('medio.patient.fields.background_condition_note')),
                ])
                ->schema([
                    Select::make('medical_condition_id')
                        ->native(false)
                        ->relationship('medicalCondition', 'name')
                        ->searchable([MedicalCondition::NAME, MedicalCondition::CODE])
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name . ' (' . $record->code . ')'),
                    Textarea::make('notes')
                ])
//                ->defaultItems(1)
                ->default([])
                ->columnSpanFull()
        ];

        $components = array_merge($components, ContactForm::addContactRepeaterForm());

        return $schema
            ->components($components);
    }
}
