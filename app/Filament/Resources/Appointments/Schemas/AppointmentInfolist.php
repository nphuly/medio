<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\Resources\Appointments\Schemas;

use App\Enums\AppointmentPriority;
use App\Enums\AppointmentStatus;
use App\Models\Schedule\Appointment;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class AppointmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make([
                        TextEntry::make(Appointment::APPOINTMENT_DATETIME)
                            ->label(__('medio.appointments.fields.appointment_datetime')),
                        TextEntry::make(Appointment::STATUS)
                            ->label(__('medio.appointments.fields.status'))
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => __("medio.settings.statuses.$state"))
                            ->color(fn ($record) => AppointmentStatus::colorFor($record->status)),
                        TextEntry::make(Appointment::PRIORITY)
                            ->label(__('medio.appointments.fields.priority'))
                            ->icon(fn ($record) => AppointmentPriority::iconFor($record->priority))
                            ->iconColor(fn ($record) => AppointmentPriority::colorFor($record->priority))
                            ->formatStateUsing(fn (string $state): string => __("medio.settings.priorities.$state")),
                        TextEntry::make(Appointment::CANCELLATION_REASON)
                            ->placeholder(__('medio.settings.no_information'))
                            ->label(__('medio.appointments.fields.cancellation_reason')),
                        TextEntry::make(Appointment::COMMENTS)
                            ->placeholder(__('medio.settings.no_information'))
                            ->label(__('medio.appointments.fields.comment')),
                    ])->label(__('medio.settings.labels.appointment_information')),
                    Section::make([
                        TextEntry::make('patient.full_name')
                            ->label(__('medio.appointments.fields.patient')),
                        PhoneEntry::make('patient.mainPhone.phone_number')
                            ->displayFormat(PhoneInputNumberType::INTERNATIONAL)
                            ->label(__('medio.phones.fields.phone_number')),
                    ])->label(__('medio.settings.labels.patient_information'))
                ])
                ->columnSpanFull(),
                RepeatableEntry::make('visits')
                    ->table([
                        RepeatableEntry\TableColumn::make(__('medio.visits.fields.examination_type')),
                        RepeatableEntry\TableColumn::make(__('medio.visits.fields.doctor')),
                    ])
                    ->label(__('medio.appointments.fields.request_for_examination'))
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('translated_examination_type'),
                        TextEntry::make('doctor.full_name')
                    ])
            ]);
    }
}
