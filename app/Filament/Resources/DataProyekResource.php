<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataProyekResource\Pages;
use App\Models\DataProyek;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;
use Filament\Actions;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Actions\Action;

class DataProyekResource extends Resource
{
    protected static ?string $model = DataProyek::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $recordTitleAttribute = 'attechment';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TextInput::make('no_rekening')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('attechment')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('d')
                    ->maxLength(100),
                Forms\Components\TextInput::make('k')
                    ->maxLength(100),
                Forms\Components\TextInput::make('s')
                    ->maxLength(100),
                Forms\Components\TextInput::make('code1')
                    ->maxLength(50),
                Forms\Components\TextInput::make('code2')
                    ->maxLength(50),
                Forms\Components\TextInput::make('penerima')
                    ->maxLength(50),
                Forms\Components\TextInput::make('pemberi')
                    ->maxLength(50),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
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
                Tables\Columns\TextColumn::make('penerima')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('pemberi')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('tanggal')
                    ->label('Filter Tanggal')
                    ->form([
                        DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn($query) => $query->whereDate('tanggal', '>=', Carbon::parse($data['from']))
                            )
                            ->when(
                                $data['until'],
                                fn($query) => $query->whereDate('tanggal', '<=', Carbon::parse($data['until']))
                            );
                    }),

                Filter::make('code1')
                    ->label('Filter Code1')
                    ->form([
                        Forms\Components\TextInput::make('code1')
                            ->label('Code1')
                            ->placeholder('Masukkan code1')
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['code1'],
                            fn($query, $code1) => $query->where('code1', 'like', "%{$code1}%")
                        );
                    }),

                    Filter::make('code2')
                    ->label('Filter Code2')
                    ->form([
                        Forms\Components\TextInput::make('code2')
                            ->label('Code2')
                            ->placeholder('Masukkan code2')
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['code2'],
                            fn($query, $code2) => $query->where('code2', 'like', "%{$code2}%")
                        );
                    }),
                ])  
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]), 
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataProyeks::route('/'),
            'create' => Pages\CreateDataProyek::route('/create'),
            'edit' => Pages\EditDataProyek::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationGroup = 'Data';

    protected static function getHeaderActions(): array
    {
        return [
            Actions\Action::make('import')
                ->label('Import Excel')
                ->action(function () {
                    return view('filament.custom.upload-filedata');  // Tambahkan tampilan upload di sini
                })
                ->color('primary'),
        ];
    }
}
