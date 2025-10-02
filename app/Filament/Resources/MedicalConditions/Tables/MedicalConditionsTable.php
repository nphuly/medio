<?php

namespace App\Filament\Resources\MedicalConditions\Tables;

use App\Models\Settings\MedicalCondition;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedicalConditionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(MedicalCondition::CODE)
                    ->label(__('medio.medical_conditions.fields.code')),
                TextColumn::make(MedicalCondition::NAME)
                    ->label(__('medio.medical_conditions.fields.name')),
                TextColumn::make(MedicalCondition::DESCRIPTION)
                    ->label(__('medio.medical_conditions.fields.description'))
                    ->limit(50),
            ])
            ->searchable()
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
