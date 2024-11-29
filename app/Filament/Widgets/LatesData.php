<?php

namespace App\Filament\Widgets;

use App\Models\DataProyek; 
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatesData extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(DataProyek::query()) 
            ->defaultPaginationPageOption(5)
            ->defaultSort(column: 'created_at', direction: 'desc') 
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_rekening')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attechment')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('d')
                    ->searchable(),
                Tables\Columns\TextColumn::make('k')
                    ->searchable(),
                Tables\Columns\TextColumn::make('s')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code2')
                    ->searchable(),
            ]);
    }
}
