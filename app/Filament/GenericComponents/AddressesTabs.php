<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\GenericComponents;

use App\Models\Settings\Address;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Parfaitementweb\FilamentCountryField\Infolists\Components\CountryEntry;

class AddressesTabs
{
    public static function make(): Tabs
    {
        return Tabs::make('addresses')
            ->columns(3)
            ->columnSpanFull()
            ->tabs(fn ($record) => $record->addresses->map(
                fn ($address, $index) => Tab::make(__('medio.addresses.types.' . $address->address_type) . ' ' . ($index + 1))
                    ->schema([
                        TextEntry::make(Address::ADDRESS_LINE_1)
                            ->label(__('medio.addresses.fields.address_line_1'))
                            ->state($address->address_line_1),
                        TextEntry::make(Address::ADDRESS_LINE_2)
                            ->label(__('medio.addresses.fields.address_line_2'))
                            ->state($address->address_line_2),
                        TextEntry::make(Address::CITY)
                            ->label(__('medio.addresses.fields.city'))
                            ->state($address->city),
                        TextEntry::make(Address::REGION)
                            ->label(__('medio.addresses.fields.region'))
                            ->state($address->region),
                        TextEntry::make(Address::POSTAL_CODE)
                            ->label(__('medio.addresses.fields.postal_code'))
                            ->state($address->postal_code),
                        CountryEntry::make(Address::COUNTRY)
                            ->label(__('medio.addresses.fields.country'))
                            ->state($address->country),
                    ])
            )->toArray());
    }
}
