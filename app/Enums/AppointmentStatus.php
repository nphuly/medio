<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Enums;

enum AppointmentStatus: string
{
    case SCHEDULED = 'scheduled';
    case CONFIRMED = 'confirmed';
    case CHECKED_IN = 'checked_in';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case NOT_INFORMED = 'not_informed';
    case RESCHEDULED = 'rescheduled';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => __('medio.settings.statuses.scheduled'),
            self::CONFIRMED => __('medio.settings.statuses.confirmed'),
            self::CHECKED_IN => __('medio.settings.statuses.checked_in'),
            self::IN_PROGRESS => __('medio.settings.statuses.in_progress'),
            self::COMPLETED => __('medio.settings.statuses.completed'),
            self::CANCELLED => __('medio.settings.statuses.cancelled'),
            self::NOT_INFORMED => __('medio.settings.statuses.not_informed'),
            self::RESCHEDULED => __('medio.settings.statuses.rescheduled'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SCHEDULED, self::RESCHEDULED, self::IN_PROGRESS => 'info',
            self::CHECKED_IN => 'gray',
            self::CONFIRMED, self::COMPLETED => 'success',
            self::NOT_INFORMED => 'warning',
            self::CANCELLED => 'danger',
        };
    }

    public static function colorFor($status): string
    {
        return self::tryFrom($status)?->color() ?? 'info';
    }

    public static function appointmentStatuses(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($status) => [
            $status->value => $status->label()
        ])->toArray();
    }
}
