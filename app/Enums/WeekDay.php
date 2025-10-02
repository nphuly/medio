<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Enums;

enum WeekDay: string
{
    case MONDAY = 'monday';
    case TUESDAY = 'tuesday';
    case WEDNESDAY = 'wednesday';
    case THURSDAY = 'thursday';
    case FRIDAY = 'friday';
    case SATURDAY = 'saturday';
    case SUNDAY = 'sunday';

    public function label(): string
    {
        return match ($this) {
            self::MONDAY => __('medio.settings.weekdays.monday'),
            self::TUESDAY => __('medio.settings.weekdays.tuesday'),
            self::WEDNESDAY => __('medio.settings.weekdays.wednesday'),
            self::THURSDAY => __('medio.settings.weekdays.thursday'),
            self::FRIDAY => __('medio.settings.weekdays.friday'),
            self::SATURDAY => __('medio.settings.weekdays.saturday'),
            self::SUNDAY => __('medio.settings.weekdays.sunday'),
        };
    }

    public static function weekDays(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($weekday) => [
            $weekday->value => $weekday->label()
        ])->toArray();
    }
}
