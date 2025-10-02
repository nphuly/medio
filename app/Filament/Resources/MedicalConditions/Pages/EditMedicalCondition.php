<?php

namespace App\Filament\Resources\MedicalConditions\Pages;

use App\Filament\Resources\MedicalConditions\MedicalConditionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMedicalCondition extends EditRecord
{
    protected static string $resource = MedicalConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
