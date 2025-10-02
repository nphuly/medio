<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\Resources\Appointments\Actions;

use App\Enums\AppointmentStatus;
use App\Models\Schedule\Appointment;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class PatientNotComingAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'patientNotComing';
    }

    public static function make(?string $name = 'patientNotComing'): static
    {
        return parent::make($name)
            ->label(__('medio.appointments.actions.patient_not_coming'))
            ->visible(fn ($record) => $record->status === AppointmentStatus::CONFIRMED->value)
            ->color('danger')
            ->action(function (Appointment $record) {
                $isCanceled = $record->update([
                    Appointment::CANCELLATION_REASON => __('medio.appointments.actions.patient_not_coming'),
                    Appointment::STATUS => AppointmentStatus::NOT_INFORMED,
                ]);

                if ($isCanceled) {
                    Notification::make()
                        ->title(__('medio.appointments.notifications.appointment_is_cancelled'))
                        ->success()
                        ->send();
                }

                $record->refresh();
            });
    }
}
