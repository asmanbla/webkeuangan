<?php

namespace App\Filament\Resources\DataProyekResource\Pages;

use App\Filament\Resources\DataProyekResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataProyek extends EditRecord
{
    protected static string $resource = DataProyekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
