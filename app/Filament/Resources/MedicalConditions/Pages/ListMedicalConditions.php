<?php

namespace App\Filament\Resources\MedicalConditions\Pages;

use App\Filament\Resources\MedicalConditions\MedicalConditionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMedicalConditions extends ListRecords
{
    protected static string $resource = MedicalConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label(__('medio.medical_conditions.actions.add_new_medical_condition')),
        ];
    }
}
