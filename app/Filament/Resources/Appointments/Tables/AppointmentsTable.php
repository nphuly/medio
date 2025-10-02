<?php

namespace App\Filament\Resources\Appointments\Tables;

use App\Enums\AppointmentPriority;
use App\Enums\AppointmentStatus;
use App\Filament\Resources\Appointments\Actions\CancelAppointment;
use App\Filament\Resources\Appointments\Actions\CheckInAppointmentAction;
use App\Filament\Resources\Appointments\Actions\ConfirmAppointmentAction;
use App\Filament\Resources\Appointments\Actions\PatientNotComingAction;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable()
            ->columns([
                TextColumn::make('status')
                    ->label(__('medio.appointments.fields.status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => __("medio.settings.statuses.$state"))
                    ->color(fn ($record) => AppointmentStatus::colorFor($record->status)),
                IconColumn::make('priority')
                    ->label(__('medio.appointments.fields.priority'))
                    ->icon(fn ($record) => AppointmentPriority::iconFor($record->priority))
                    ->color(fn ($record) => AppointmentPriority::colorFor($record->priority)),
                TextColumn::make('appointment_datetime')
                    ->label(__('medio.appointments.fields.appointment_datetime')),
                TextColumn::make('patient.fullName')
                    ->label(__('medio.appointments.fields.patient'))
            ])
            ->filters([
                Filter::make('appointment_month')
                    ->schema([
                        DatePicker::make('month')
                            ->label(__('medio.appointments.filters.month'))
                            ->displayFormat('m-Y')
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        if (empty($data['month'])) {
                            return $query;
                        }

                        $date = Carbon::parse($data['month']);
                        return $query->whereMonth('appointment_datetime', $date->month)
                            ->whereYear('appointment_datetime', $date->year);
                }),
                Filter::make('appointment_date')
                    ->schema([
                        DatePicker::make('date')
                            ->label(__('medio.appointments.filters.date'))
                            ->displayFormat('d-m-Y')
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        if (empty($data['date'])) {
                            return $query;
                        }

                        $date = Carbon::parse($data['date']);
                        return $query
                            ->whereDate('appointment_datetime', $date);
                    })
            ])
            ->recordActions([
                ViewAction::make()->extraModalFooterActions([
                    ConfirmAppointmentAction::make(),
                    CheckInAppointmentAction::make(),
                    PatientNotComingAction::make(),
                    CancelAppointment::make()
                ]),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
