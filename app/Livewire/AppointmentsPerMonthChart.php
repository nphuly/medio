<?php

namespace App\Livewire;

use App\Enums\AppointmentStatus;
use App\Models\Schedule\Appointment;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Htmlable;

class AppointmentsPerMonthChart extends ChartWidget
{

    public function getHeading(): string|Htmlable|null
    {
        return __('medio.charts.appointments_per_month.heading');
    }

    protected function getData(): array
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $filteredStatuses = [
            AppointmentStatus::SCHEDULED->value,
            AppointmentStatus::COMPLETED->value,
            AppointmentStatus::CANCELLED->value
        ];

        $appointments = Appointment::query()
            ->selectRaw('MONTH(' . Appointment::APPOINTMENT_DATETIME . ') as month, status, COUNT(*) as total')
            ->whereBetween(Appointment::APPOINTMENT_DATETIME , [$startOfYear, $endOfYear])
            ->whereIn('status', $filteredStatuses)
            ->groupBy('month', 'status')
            ->get()
            ->groupBy('status'); // [1 => 120, 2 => 85, ...]

        $labels = [];
        for ($m = 1; $m <= 12; $m++) {
            $labels[] = sprintf('%02d/%d', $m, now()->year);
        }

        $datasets = [];

        foreach ($appointments as $status => $records) {
            $data = [];
            for ($m = 1; $m <= 12; $m++) {
                $record = $records->firstWhere('month', $m);
                $data[] = $record?->total ?? 0;
            }

            $datasets[] = [
                'label' => __('medio.settings.statuses.' . $status),
                'data' => $data,
                'borderColor' => $this->filamentColorToHex(AppointmentStatus::colorFor($status)),
                'backgroundColor' => $this->filamentColorToHex(AppointmentStatus::colorFor($status)),
                'fill' => false,
                'tension' => 0.3,
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
