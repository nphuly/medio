<?php

namespace App\Filament\Resources\Doctors\Schemas;

use App\Enums\DoctorSpeciality;
use App\Enums\WeekDay;
use App\Filament\GenericComponents\ContactForm;
use App\Models\Doctors\Doctor;
use App\Models\Doctors\DoctorWorkSchedule;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        $components = [
            TextInput::make(Doctor::FIRST_NAME)
                ->label(__('medio.doctor.fields.first_name'))
                ->required(),
            TextInput::make(Doctor::MIDDLE_NAME)
                ->label(__('medio.doctor.fields.middle_name')),
            TextInput::make(Doctor::LAST_NAME)
                ->label(__('medio.doctor.fields.last_name'))
                ->required(),
            TextInput::make(Doctor::EMAIL)
                ->label(__('medio.doctor.fields.email'))
                ->email(),
            DatePicker::make(Doctor::DOB)
                ->label(__('medio.doctor.fields.dob'))
                ->native(false)
                ->required(),
            Select::make(Doctor::SPECIALITY)
                ->label(__('medio.doctor.fields.speciality'))
                ->native(false)
                ->searchable()
                ->options(DoctorSpeciality::specialities())
                ->required(),
            Select::make(Doctor::GENDER)
                ->label(__('medio.doctor.fields.gender'))
                ->native(false)
                ->options([
                    'male' => __('medio.settings.genders.male'),
                    'female' => __('medio.settings.genders.female'),
                    'other' => __('medio.settings.genders.other'),
                ])
                ->required(),
            Repeater::make('workSchedule')
                ->label(__('medio.doctor.fields.work_schedule'))
                ->relationship()
                ->table([
                    Repeater\TableColumn::make(__('medio.doctor.work_schedule.day')),
                    Repeater\TableColumn::make(__('medio.doctor.work_schedule.start_time')),
                    Repeater\TableColumn::make(__('medio.doctor.work_schedule.end_time')),
                ])
                ->schema([
                    Select::make(DoctorWorkSchedule::DAY)
                        ->label(__('medio.doctor.work_schedule.day'))
                        ->native(false)
                        ->options(WeekDay::weekDays())
                        ->required(),
                    TimePicker::make(DoctorWorkSchedule::START_TIME)
                        ->label(__('medio.doctor.work_schedule.start_time'))
                        ->seconds(false)
                        ->required(),
                    TimePicker::make(DoctorWorkSchedule::END_TIME)
                        ->label(__('medio.doctor.work_schedule.end_time'))
                        ->seconds(false)
                        ->required(),
                ])
                ->default([])
                ->cloneable()
                ->columnSpanFull()
        ];

        $components = array_merge($components, ContactForm::addContactRepeaterForm());

        return $schema
            ->components($components);
    }
}
