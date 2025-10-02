<?php

namespace App\Livewire;

use App\Enums\AppointmentStatus;
use App\Models\Schedule\Appointment;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Htmlable;

class AppointmentsPerWeekChart extends ChartWidget
{
    public function getHeading(): string|Htmlable|null
    {
        return __('medio.charts.appointments_per_week.heading');
    }

    protected function getData(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $filteredStatuses = [
            AppointmentStatus::SCHEDULED->value,
            AppointmentStatus::COMPLETED->value,
            AppointmentStatus::CANCELLED->value
        ];

        $rawVisits = Appointment::query()
            ->selectRaw('DATE(' . Appointment::APPOINTMENT_DATETIME . ') as day, status, COUNT(*) as total')
            ->whereBetween(Appointment::APPOINTMENT_DATETIME, [$startOfWeek, $endOfWeek])
            ->whereIn('status', $filteredStatuses)
            ->groupBy('day', 'status')
            ->get();

        $visits = [];
        foreach ($rawVisits as $row) {
            $visits[$row->status][$row->day] = $row->total;
        }

        $days = iterator_to_array($startOfWeek->toPeriod($endOfWeek));
        $labels = collect($days)->map(fn ($d) => $d->format('d/m'))->toArray();

        $datasets = [];
        foreach ($filteredStatuses as $status) {
            $data = [];
            foreach ($days as $date) {
                $day = $date->toDateString();
                $data[] = $visits[$status][$day] ?? 0;
            }

            $datasets[] = [
                'label' => __('medio.settings.statuses.' . $status),
                'data' => $data,
                'borderColor' => $this->filamentColorToHex(AppointmentStatus::colorFor($status)),
                'backgroundColor' => $this->filamentColorToHex(AppointmentStatus::colorFor($status)),
                'tension' => 0.3,
                'fill' => false,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function filamentColorToHex(string $color): string
    {
        return [
            'info'    => '#3b82f6',
            'success' => '#10b981',
            'warning' => '#f59e0b',
            'danger'  => '#ef4444',
            'gray'    => '#6b7280',
        ][$color] ?? '#000000';
    }
}
