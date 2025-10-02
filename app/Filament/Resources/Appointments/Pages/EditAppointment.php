<?php

namespace App\Filament\Resources\Appointments\Pages;

use App\Filament\Resources\Appointments\Actions\CancelAppointment;
use App\Filament\Resources\Appointments\Actions\CheckInAppointmentAction;
use App\Filament\Resources\Appointments\Actions\ConfirmAppointmentAction;
use App\Filament\Resources\Appointments\Actions\PatientNotComingAction;
use App\Filament\Resources\Appointments\AppointmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ConfirmAppointmentAction::make(),
            CheckInAppointmentAction::make(),
            PatientNotComingAction::make(),
            CancelAppointment::make(),
//            DeleteAction::make(),
        ];
    }
}
