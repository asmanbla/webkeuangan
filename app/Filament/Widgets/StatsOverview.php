<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\DataProyek;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    protected static bool $isLazy = true;

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make(label:'Total Data Proyek', value:DataProyek::count())
                ->description(description: 'Increase in data proyek')
                ->descriptionIcon(icon: 'heroicon-m-arrow-trending-up')
                ->color(color:'primary')
                ->chart([7, 3, 4, 5, 6, 5, 4]),

            Stat::make(label:'Total Pengguna', value:User::count())
                ->description(description: 'Total User In Website')
                ->descriptionIcon(icon: 'heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7, 3, 4, 5, 6, 5, 4]),

            Stat::make(label: 'Total Proyek dengan Code1 2.1', value: DataProyek::where('code1', '2.1')->count())
                ->description(description: 'Jumlah proyek dengan code1 : 2.1')
                ->descriptionIcon(icon: 'heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([5, 3, 6, 2, 4, 3, 2]),
        ];
            
    }
}
