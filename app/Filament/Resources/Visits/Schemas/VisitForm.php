<?php

namespace App\Filament\Resources\Visits\Schemas;

use App\Enums\AppointmentStatus;
use App\Filament\Resources\Patients\Schemas\PatientInfolist;
use App\Models\Doctors\Doctor;
use App\Models\Schedule\Visit;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

class VisitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('appointment.appointment_datetime')
                    ->label(__('medio.visits.fields.appointment_datetime')),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => __("medio.settings.statuses.$state"))
                    ->color(fn ($record) => AppointmentStatus::colorFor($record->status))
                    ->label(__('medio.visits.fields.status')),
                TextEntry::make('translated_examination_type')
                    ->label(__('medio.visits.fields.examination_type')),
                TextEntry::make('appointment.patient.full_name')
                    ->label(__('medio.visits.fields.patient'))
                    ->suffixAction(
                        Action::make('viewPatient')
                            ->icon(Heroicon::OutlinedInformationCircle)
                            ->color('info')
                            ->modalHeading(__('medio.settings.labels.patient_information'))
                            ->modalWidth(Width::SixExtraLarge)
                            ->modalSubmitAction(false)
                            ->schema(function ($record, $schema) {
                                return PatientInfolist::configure($schema)->record($record->appointment->patient);
                            })
                    ),
                Select::make(Visit::DOCTOR_ID)
                    ->searchable()
                    ->native(false)
                    ->options(Doctor::all()->pluck('full_name','id'))
                    ->label(__('medio.visits.fields.doctor')),
                DatePicker::make(Visit::COME_BACK_DATE)
                    ->label(__('medio.visits.fields.comeback_date')),
                TextArea::make(Visit::SYMPTOMS)
                    ->columnSpanFull()
                    ->rows(3)
                    ->label(__('medio.visits.fields.symptoms')),
                TextArea::make(Visit::DIAGNOSIS)
                    ->columnSpanFull()
                    ->rows(3)
                    ->label(__('medio.visits.fields.diagnosis')),
                TextArea::make(Visit::TREATMENT)
                    ->columnSpanFull()
                    ->rows(3)
                    ->label(__('medio.visits.fields.treatment')),
            ])->columns(3);
    }
}
