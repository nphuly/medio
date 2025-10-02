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

class VisitCompletedAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'visitCompleted';
    }

    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->label(__('medio.settings.statuses.completed'))
            ->color('success')
            ->visible(fn ($record) => $record->status === AppointmentStatus::IN_PROGRESS->value)
            ->action(function (Visit $record) {
                $isInProgress = $record->update([
                    Visit::STATUS => AppointmentStatus::COMPLETED->value,
                ]);

                if ($isInProgress) {
                    Notification::make()
                        ->title(AppointmentStatus::COMPLETED->label())
                        ->success()
                        ->send();
                }

                $record->appointment->update([
                    Appointment::STATUS => AppointmentStatus::COMPLETED->value,
                ]);

                $record->refresh();
            });
    }
}
