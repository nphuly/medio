<?php

namespace App\Filament\Resources\Visits\Pages;

use App\Filament\Resources\Visits\Actions\VisitCompletedAction;
use App\Filament\Resources\Visits\Actions\VisitInProgressAction;
use App\Filament\Resources\Visits\VisitResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVisit extends EditRecord
{
    protected static string $resource = VisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            VisitInProgressAction::make(),
            VisitCompletedAction::make(),
            DeleteAction::make(),
        ];
    }
}
