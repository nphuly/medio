<?php

namespace App\Filament\Resources\MedicalConditions\Schemas;

use App\Models\Settings\MedicalCondition;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MedicalConditionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make(MedicalCondition::NAME)
                    ->label(__('medio.medical_conditions.fields.name'))
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $code = collect(explode(' ', $state))
                            ->map(fn ($word) => mb_substr($word, 0, 1, 'UTF-8'))
                            ->join('');
                        $set(MedicalCondition::CODE, mb_strtoupper($code, 'UTF-8'));
                    }),
                TextInput::make(MedicalCondition::CODE)
                    ->disabled()
                    ->dehydrated()
                    ->label(__('medio.medical_conditions.fields.code')),
                Textarea::make(MedicalCondition::DESCRIPTION)
                    ->label(__('medio.medical_conditions.fields.description'))
                    ->columnSpanFull()
                    ->rows(4)
            ]);
    }
}
