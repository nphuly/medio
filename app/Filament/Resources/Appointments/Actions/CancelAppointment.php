<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\Resources\Appointments\Actions;

use App\Enums\AppointmentStatus;
use App\Models\Schedule\Appointment;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

class CancelAppointment extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'cancelAppointment';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('medio.appointments.actions.cancel_appointment'));

        $this->modalHeading(fn (): string => __('medio.appointments.actions.cancel_appointment', ['label' => $this->getRecordTitle()]));

        $this->schema([
            Textarea::make(Appointment::CANCELLATION_REASON)
                ->label(__('medio.appointments.fields.cancellation_reason'))
                ->rows(4)
                ->required()
        ]);

        $this->action(function (Appointment $record, array $data) {
            $isCanceled = $record->update([
                Appointment::CANCELLATION_REASON => $data[Appointment::CANCELLATION_REASON],
                Appointment::STATUS => AppointmentStatus::CANCELLED,
            ]);

            if ($isCanceled) {
                Notification::make()
                    ->title(__('medio.appointments.notifications.appointment_is_cancelled'))
                    ->success()
                    ->send();
            }
        });

        $this->record?->refresh();
    }

    public static function make(?string $name = 'cancelAppointment'): static
    {
        $filteredStatuses = [
            AppointmentStatus::CONFIRMED->value,
            AppointmentStatus::SCHEDULED->value,
            AppointmentStatus::RESCHEDULED->value,
        ];
        return parent::make($name)
            ->label(__('medio.appointments.actions.cancel_appointment'))
            ->visible(fn ($record) => in_array($record->status, $filteredStatuses))
            ->color('danger');
    }
}
