<?php

namespace App\Livewire;

use App\Enums\AppointmentStatus;
use App\Models\Doctors\Doctor;
use App\Models\Patients\Patient;
use App\Models\Schedule\Appointment;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        return [
            Stat::make(__('medio.stats_widgets.stats_overview.stats.sum_of_patients.label'), Patient::count())
                ->description(__('medio.stats_widgets.stats_overview.stats.sum_of_patients.description'))
                ->icon('hugeicons-patient')
                ->color('info'),

            Stat::make(__('medio.stats_widgets.stats_overview.stats.sum_of_doctors.label'), Doctor::count())
                ->description(__('medio.stats_widgets.stats_overview.stats.sum_of_doctors.description'))
                ->icon('hugeicons-doctor-01')
                ->color('info'),

            Stat::make(
                    __('medio.stats_widgets.stats_overview.stats.sum_of_completed_appointments_today.label'),
                    Appointment::whereDate(Appointment::CHECKED_IN_AT, $today)
                        ->where(Appointment::STATUS, '=', AppointmentStatus::COMPLETED->value)
                        ->count()
                )
                ->description(__('medio.stats_widgets.stats_overview.stats.sum_of_completed_appointments_today.description') . $today->format('d/m'))
                ->icon('carbon-reminder-medical')
                ->color('success'),

            Stat::make(
                    __('medio.stats_widgets.stats_overview.stats.sum_of_completed_appointments_this_week.label'),
                    Appointment::whereBetween(Appointment::CHECKED_IN_AT, [$startOfWeek, $endOfWeek])
                        ->where(Appointment::STATUS, '=', AppointmentStatus::COMPLETED->value)
                        ->count()
                )
                ->description(__('medio.stats_widgets.stats_overview.stats.sum_of_completed_appointments_this_week.description') . "{$startOfWeek->format('d/m')} - {$endOfWeek->format('d/m')}")
                ->icon('carbon-reminder-medical')
                ->color('success'),
        ];
    }
}
