<?php

namespace App\Imports;

use App\Models\DataProyek;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MyDataProyekImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Melewatkan header (misalnya pada baris pertama)
        $collection->skip(1)->each(function ($row) {
            DataProyek::create([
                'tanggal' => $row[0],
                'no_rekening' => $row[1],
                'attechment' => $row[2],
                'd' => $row[3],
                'k' => $row[4],
                's' => $row[5],
                'code1' => $row[6],
                'code2' => $row[7],
                'penerima' => $row[8],
                'pemberi' => $row[9],
            ]);
        });
    }
}
