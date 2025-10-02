<?php

/**
 * @author  lpn
 * @ticket
 */

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

class VisitInfolist
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
                TextEntry::make('doctor.full_name')
                    ->label(__('medio.visits.fields.doctor'))
                    ->placeholder(__('medio.settings.no_information')),
                TextEntry::make(Visit::COME_BACK_DATE)
                    ->placeholder(__('medio.settings.no_information'))
                    ->label(__('medio.visits.fields.comeback_date')),
                TextEntry::make(Visit::SYMPTOMS)
                    ->columnSpanFull()
                    ->placeholder(__('medio.settings.no_information'))
                    ->label(__('medio.visits.fields.symptoms')),
                TextEntry::make(Visit::DIAGNOSIS)
                    ->columnSpanFull()
                    ->placeholder(__('medio.settings.no_information'))
                    ->label(__('medio.visits.fields.diagnosis')),
                TextEntry::make(Visit::TREATMENT)
                    ->columnSpanFull()
                    ->placeholder(__('medio.settings.no_information'))
                    ->label(__('medio.visits.fields.treatment')),
            ])->columns(3);
    }
}
