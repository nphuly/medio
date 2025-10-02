<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Filament\GenericComponents;

use App\Models\Settings\Phone;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class PhonesRepeatableEntry
{
    public static function make(): RepeatableEntry
    {
        return RepeatableEntry::make('phones')
            ->label(__('medio.phones.translation_plural'))
            ->placeholder(__('medio.settings.no_information'))
            ->table([
                RepeatableEntry\TableColumn::make(__('medio.phones.fields.phone_type')),
                RepeatableEntry\TableColumn::make(__('medio.phones.fields.phone_number')),
                RepeatableEntry\TableColumn::make(__('medio.phones.fields.is_main')),
            ])
            ->schema([
                TextEntry::make(Phone::PHONE_TYPE)
                    ->formatStateUsing(fn (string $state): string => __("medio.phones.types.$state")),
                PhoneEntry::make(Phone::PHONE_NUMBER)
                    ->displayFormat(PhoneInputNumberType::INTERNATIONAL),
                IconEntry::make(Phone::IS_MAIN)
                    ->boolean()
            ])
            ->columnSpanFull();
    }
}
