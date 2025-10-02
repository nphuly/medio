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

class ConfirmAppointmentAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'confirmAppointment';
    }

    public static function make(?string $name = 'confirmAppointment'): static
    {
        $filteredStatuses = [
            AppointmentStatus::SCHEDULED->value,
            AppointmentStatus::RESCHEDULED->value,
        ];

        return parent::make($name)
            ->label(__('medio.appointments.actions.confirm'))
            ->color('success')
            ->visible(fn ($record) => in_array($record->status, $filteredStatuses))
            ->action(function (Appointment $record) {
                $isConfirmed = $record->update([
                    Appointment::STATUS => AppointmentStatus::CONFIRMED,
                ]);

                if ($isConfirmed) {
                    Notification::make()
                        ->title(AppointmentStatus::CONFIRMED->label())
                        ->success()
                        ->send();
                }

                $record->refresh();
            });
    }
}
