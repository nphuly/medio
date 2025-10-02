<?php

namespace App\Filament\Resources\MedicalConditions;

use App\Filament\Resources\MedicalConditions\Pages\CreateMedicalCondition;
use App\Filament\Resources\MedicalConditions\Pages\EditMedicalCondition;
use App\Filament\Resources\MedicalConditions\Pages\ListMedicalConditions;
use App\Filament\Resources\MedicalConditions\Schemas\MedicalConditionForm;
use App\Filament\Resources\MedicalConditions\Tables\MedicalConditionsTable;
use App\Models\Settings\MedicalCondition;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MedicalConditionResource extends Resource
{
    protected static ?string $model = MedicalCondition::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCircleStack;

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return MedicalConditionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MedicalConditionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMedicalConditions::route('/'),
            'create' => CreateMedicalCondition::route('/create'),
            'edit' => EditMedicalCondition::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('medio.medical_conditions.translation');
    }

    public static function getNavigationLabel(): string
    {
        return __('medio.medical_conditions.translation_plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('medio.settings.internal_navigation_group');
    }
}
