<?php

namespace App\Imports;

use App\Models\DataProyek;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;


class ImportDataProyeks implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Cek dan konversi tanggal
        $tanggal = null;
        if (!empty($row[0])) {
            try {
                $tanggal = Carbon::createFromFormat('d-M-y', $row[0])->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                $tanggal = null; // Set null jika format tanggal tidak valid
            }
        }
    
        return new DataProyek([
            'tanggal' => $tanggal,
            'no_rekening' => $row[1],
            'attechment' => $row[2],
            'd'  => $row[3],
            'k'  => $row[4],
            's'  => $row[5],
            'code1'  => $row[6],
            'code2'  => $row[7],
            'penerima'  => $row[8],
            'pemberi' => $row[9],
        ]);
    }
    
    
}
