<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\DataProyek;
use Carbon\Carbon;

class DataKeuanganChart extends ChartWidget
{
    protected static ?string $heading = 'Chart With 2.1 Code';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = $this->getDataProyeksPerMonthByAttachment();
        return [
            'datasets' => $data['datasets'],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getDataProyeksPerMonthByAttachment(): array
    {
        $now = Carbon::now();
        $months = collect(range(1, 12))->map(fn($month) => $now->month($month)->format('M'))->toArray();
        $attachments = DataProyek::where('code1', '2.1')
            ->select('attechment')
            ->distinct()
            ->pluck('attechment');

        $datasets = [];
        
        foreach ($attachments as $attachment) {
            $dataPerMonth = [];
            foreach (range(1, 12) as $month) {
                $count = DataProyek::whereMonth('created_at', $month)
                    ->whereYear('created_at', $now->year)
                    ->where('attechment', $attachment)
                    ->where('code1', '2.1')
                    ->count();
                $dataPerMonth[] = $count;
            }
            $datasets[] = [
                'label' => "Attachment: $attachment",
                'data' => $dataPerMonth,
            ];
        }

        return [
            'datasets' => $datasets,
            'months' => $months,
        ];
    }
}
