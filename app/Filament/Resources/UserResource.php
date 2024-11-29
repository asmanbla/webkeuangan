<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Exports\DataExport;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'User';

    protected static ?string $navigationLabel = 'Admin Users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                     ->required(),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('password')
                    ->password()      
                    ->required()
                    ->maxLength(8),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
            ->searchable()
            ->sortable(),
            Tables\Columns\TextColumn::make('email')
            ->searchable()
            ->sortable(),
            Tables\Columns\TextColumn::make('password')
            ->toggleable(),
        ])
        ->filters([
            // Tambahkan filter jika perlu
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
        ]);
        // ->headerActions([
        //     Tables\Actions\CreateAction::make(),
        // ]);
    
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Tables\Actions\CreateAction::make(), // Tombol "New User"
            Tables\Actions\Action::make('unduh')
                ->label('Unduh Data')
                ->icon('heroicon-s-download') // Gunakan ikon valid dari Heroicons
                ->color('primary') // Warna tombol bisa disesuaikan
                ->action(function () {
                    // Eksekusi unduhan file
                    return Excel::download(new DataExport, 'data.xlsx');
                }),
            ];
    }

    public static function getNavigationBadge(): ?string 
    {
        return static::getModel()::count();
    }



}
