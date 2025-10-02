<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Enums;

enum AppointmentPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => __('medio.settings.priorities.low'),
            self::MEDIUM => __('medio.settings.priorities.medium'),
            self::HIGH => __('medio.settings.priorities.high'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::LOW => 'info',
            self::MEDIUM => 'warning',
            self::HIGH => 'danger',
        };
    }

    public static function colorFor($priority): string
    {
        return self::tryFrom($priority)?->color() ?? 'info';
    }

    public function icon(): string
    {
        return match ($this) {
            self::LOW => 'ri-arrow-down-double-line',
            self::MEDIUM => 'heroicon-c-bars-2',
            self::HIGH => 'ri-arrow-up-double-line',
        };
    }

    public static function iconFor($priority): string
    {
        return self::tryFrom($priority)?->icon() ?? 'heroicon-c-bars-2';
    }

    public static function appointmentPriorities(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($status) => [
            $status->value => $status->label()
        ])->toArray();
    }
}
