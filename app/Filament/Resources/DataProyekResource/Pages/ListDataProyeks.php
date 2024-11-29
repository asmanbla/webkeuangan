<?php

namespace App\Filament\Resources\DataProyekResource\Pages;

use App\Filament\Resources\DataProyekResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use App\Models\DataProyek;
use App\Imports\ImportDataProyeks;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;

class ListDataProyeks extends ListRecords
{
    protected static string $resource = DataProyekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeader(): ?View
    {
        $dataproyek = Actions\CreateAction::make();
        return view('filament.custom.upload-filedata', compact('dataproyek'));
    }

    public $file = '';

    public function save()
    {
        if($this->file != '') {
            Excel::import(new ImportDataProyeks, $this->file);
        }

        // DataProyek::create([
        //     'tanggal' => '26/10/24',
        //     'no_rekening' => '1640000871204',
        //     'attechment' => 'Bonus PH PMI',
        //     'd' => ' Rp1.000.000 ',
        //     'k' => '',
        //     's' => '',
        //     'code1' => '2.1',
        //     'code2' => 'ph-2-5',
        //     'penerima' => 'Sakri',
        //     'pemberi' => '',
        // ]);
    }
    
}
