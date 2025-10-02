<?php

namespace App\Filament\Resources\Visits\Tables;

use App\Enums\AppointmentStatus;
use App\Models\Schedule\Visit;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Phiki\Phast\Text;

class VisitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->searchable()
            ->columns([
                TextColumn::make('appointment.appointment_datetime')
                    ->label(__('medio.visits.fields.appointment_datetime')),
                TextColumn::make(Visit::VISIT_DATE)
                    ->label(__('medio.visits.fields.visit_date')),
                TextColumn::make(Visit::COME_BACK_DATE)
                    ->label(__('medio.visits.fields.comeback_date')),
                TextColumn::make(Visit::STATUS)
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => __("medio.settings.statuses.$state"))
                    ->color(fn ($record) => AppointmentStatus::colorFor($record->status))
                    ->label(__('medio.visits.fields.status')),
                TextColumn::make('appointment.patient.full_name')
                    ->label(__('medio.visits.fields.patient')),
                TextColumn::make('doctor.full_name')
                    ->label(__('medio.visits.fields.doctor')),
            ])
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
