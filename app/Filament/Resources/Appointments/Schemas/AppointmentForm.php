<?php

namespace App\Filament\Resources\Appointments\Schemas;

use App\Enums\AppointmentPriority;
use App\Enums\AppointmentStatus;
use App\Enums\DoctorSpeciality;
use App\Filament\Resources\Patients\Schemas\PatientForm;
use App\Filament\Resources\Patients\Schemas\PatientInfolist;
use App\Models\Patients\Patient;
use App\Models\Schedule\Appointment;
use App\Models\Schedule\Visit;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make(Appointment::APPOINTMENT_DATETIME)
                    ->required()
//                    ->native(false)
                    ->seconds(false)
                    ->label(__('medio.appointments.fields.appointment_datetime')),
                Select::make(Appointment::PATIENT_ID)
                    ->label(__('medio.appointments.fields.patient'))
                    ->disabled(function ($livewire) {
                        return !empty($livewire->record);
                    })
                    ->required()
                    ->relationship('patient', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                    ->preload()
                    ->searchable([Patient::FIRST_NAME, Patient::LAST_NAME, Patient::MIDDLE_NAME])
                    ->createOptionModalHeading(__('medio.patient.actions.add_patient'))
                    ->createOptionForm(function ($schema) {
                        return PatientForm::configure($schema);
                    })
                    ->suffixAction(
                        Action::make('viewPatient')
                            ->icon(Heroicon::OutlinedInformationCircle)
                            ->modalHeading(__('medio.settings.labels.patient_information'))
                            ->modalWidth(Width::SixExtraLarge)
                            ->modalSubmitAction(false)
                            ->schema(function ($record, $schema) {
                                return PatientInfolist::configure($schema)->record($record->patient);
                            })
                    ),
                Select::make(Appointment::STATUS)
                    ->label(__('medio.appointments.fields.status'))
                    ->disabled()
                    ->default(AppointmentStatus::SCHEDULED->value)
                    ->dehydrated()
                    ->live(true)
                    ->options(AppointmentStatus::appointmentStatuses())
                    ->formatStateUsing(function ($state, $livewire) {
                        // If it is a new creation page and there is no record => default is Scheduled
                        if ($livewire instanceof CreateRecord || ! $livewire->record) {
                            return AppointmentStatus::SCHEDULED->value;
                        }

                        // In case of editing => take the value from dB
                        return $state;
                    }),
                Select::make(Appointment::PRIORITY)
                    ->label(__('medio.appointments.fields.priority'))
                    ->required()
                    ->native(false)
                    ->options(AppointmentPriority::appointmentPriorities()),
                TextArea::make(Appointment::COMMENTS)
                    ->label(__('medio.appointments.fields.comment'))
                    ->columnSpanFull(),
                TextEntry::make(Appointment::CANCELLATION_REASON)
                    ->label(__('medio.appointments.fields.cancellation_reason'))
                    ->columnSpanFull(),
                Repeater::make('visits')
                    ->label(__('medio.appointments.fields.request_for_examination'))
                    ->relationship()
                    ->columnSpanFull()
                    ->cloneable()
                    ->table([
                        Repeater\TableColumn::make(__('medio.visits.fields.examination_type')),
                        Repeater\TableColumn::make(__('medio.visits.fields.doctor')),
                    ])
                    ->schema([
                        Select::make(Visit::EXAMINATION_TYPE)
                            ->label(__('medio.visit.fields.examination_type'))
                            ->native(false)
                            ->searchable()
                            ->options(DoctorSpeciality::specialities())
                            ->required(),
                        Select::make(Visit::DOCTOR_ID)
                            ->label(__('medio.visit.fields.doctor'))
                            ->searchable([Patient::FIRST_NAME, Patient::LAST_NAME, Patient::MIDDLE_NAME])
                            ->relationship('doctor', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                            ->required(),
                        Hidden::make(Visit::STATUS)
                            ->label(__('medio.visits.fields.status'))
                            ->default(AppointmentStatus::SCHEDULED->value)
                            ->dehydrated()
                    ])
            ]);
    }
}
