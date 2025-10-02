<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Enums;

enum AddressType: string
{
    case OFFICE = 'office';
    case HOME = 'home';

    public function label(): string
    {
        return match ($this) {
            self::OFFICE => __('medio.addresses.types.office'),
            self::HOME => __('medio.addresses.types.home'),
        };
    }

    public static function addressTypes(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($type) => [
            $type->value => $type->label()
        ])->toArray();
    }
}
