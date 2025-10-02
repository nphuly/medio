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

class CheckInAppointmentAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'checkinAppointment';
    }

    public static function make(?string $name = 'checkinAppointment'): static
    {
        return parent::make($name)
            ->label(__('medio.appointments.actions.check_in_appointment'))
            ->color('info')
            ->visible(fn ($record) => $record->status === AppointmentStatus::CONFIRMED->value)
            ->action(function (Appointment $record) {
                $isCheckedIn = $record->update([
                    Appointment::STATUS => AppointmentStatus::CHECKED_IN,
                    Appointment::CHECKED_IN_AT => now(),
                ]);

                if ($isCheckedIn) {
                    Notification::make()
                        ->title(AppointmentStatus::CHECKED_IN->label())
                        ->success()
                        ->send();
                }

                foreach ($record->visits as $visit) {
                    $visit->update([
                        Appointment::STATUS => AppointmentStatus::CHECKED_IN,
                    ]);
                }

                $record->refresh();
            });
    }
}
