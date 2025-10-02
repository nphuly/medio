<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\GenericComponents;

use App\Enums\AddressType;
use App\Enums\PhoneType;
use App\Models\Settings\Address;
use App\Models\Settings\Phone;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ContactForm
{
    public static function addContactRepeaterForm(): array
    {
        return [
            // Phones
            Repeater::make('phones')
                ->label(__('medio.phones.translation_plural'))
                ->relationship()
                ->table([
                    Repeater\TableColumn::make(__('medio.phones.fields.phone_type')),
                    Repeater\TableColumn::make(__('medio.phones.fields.phone_number')),
                    Repeater\TableColumn::make(__('medio.phones.fields.is_main'))
                ])
                ->schema([
                    Select::make(Phone::PHONE_TYPE)
                        ->native(false)
                        ->required()
                        ->options(PhoneType::phoneTypes()),
                    PhoneInput::make(Phone::PHONE_NUMBER)
                        ->required(),
                    Checkbox::make(Phone::IS_MAIN)
                        ->distinct()
                ])
                ->default([])
                ->columnSpanFull()
                ->itemLabel(fn (array $state): ?string =>
                $state['phone_type']
                    ? PhoneType::tryFrom($state['phone_type'])->label()
                    : __('medio.phones.translation')
                )
                ->addActionLabel(__('medio.phones.actions.add_new_phone')),

            // Addresses
            Repeater::make('addresses')
                ->label(__('medio.addresses.translation_plural'))
                ->relationship()
                ->schema([
                    Select::make(Address::ADDRESS_TYPE)
                        ->label(__('medio.addresses.fields.address_type'))
                        ->native(false)
                        ->options(AddressType::addressTypes())
                        ->required(),
                    TextInput::make(Address::ADDRESS_LINE_1)
                        ->label(__('medio.addresses.fields.address_line_1'))
                        ->required(),
                    TextInput::make(Address::ADDRESS_LINE_2)
                        ->label(__('medio.addresses.fields.address_line_2')),
                    TextInput::make(Address::CITY)
                        ->label(__('medio.addresses.fields.city'))
                        ->required(),
                    TextInput::make(Address::REGION)
                        ->label(__('medio.addresses.fields.region'))
                        ->required(),
                    TextInput::make(Address::POSTAL_CODE)
                        ->label(__('medio.addresses.fields.postal_code')),
                    Country::make(Address::COUNTRY)
                        ->label(__('medio.addresses.fields.country'))
                        ->required(),
                ])
                ->columnSpanFull()
                ->columns(2)
                ->itemLabel(fn (array $state): ?string =>
                $state[Address::ADDRESS_TYPE]
                    ? AddressType::tryFrom($state[Address::ADDRESS_TYPE])->label()
                    : __('medio.addresses.translation')
                )
                ->default([])
                ->collapsible()
                ->addActionLabel(__('medio.addresses.actions.add_new_address')),
        ];
    }
}
