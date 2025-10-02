<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Enums;

enum PhoneType: string
{
    case MOBILE = 'mobile';
    case LANDLINE = 'landline';
    case WORK = 'work';
    case FAX = 'fax';

    public function label(): string
    {
        return match ($this) {
            self::MOBILE => __('medio.phones.types.mobile'),
            self::LANDLINE => __('medio.phones.types.landline'),
            self::WORK => __('medio.phones.types.work'),
            self::FAX => __('medio.phones.types.fax'),
        };
    }

    public static function phoneTypes(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($type) => [
            $type->value => $type->label()
        ])->toArray();
    }
}
