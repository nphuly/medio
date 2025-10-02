<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\Resources\Visits\Actions;

use App\Enums\AppointmentStatus;
use App\Models\Schedule\Appointment;
use App\Models\Schedule\Visit;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class VisitInProgressAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'visitInProgress';
    }

    public static function make(?string $name = 'visitInProgress'): static
    {
        return parent::make($name)
            ->label(__('medio.settings.statuses.in_progress'))
            ->color('info')
            ->visible(fn ($record) => $record->appointment->status === AppointmentStatus::CHECKED_IN->value)
            ->action(function (Visit $record) {
                $isInProgress = $record->update([
                    Visit::STATUS => AppointmentStatus::IN_PROGRESS->value,
                    Visit::VISIT_DATE => now()
                ]);

                if ($isInProgress) {
                    Notification::make()
                        ->title(AppointmentStatus::IN_PROGRESS->label())
                        ->success()
                        ->send();
                }

                $record->appointment->update([
                    Appointment::STATUS => AppointmentStatus::IN_PROGRESS->value,
                ]);

                $record->refresh();
            });
    }
}
