<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataProyek extends Model
{
    protected $fillable = [
        'tanggal',
        'no_rekening',
        'attechment',
        'd',
        'k',
        's',
        'code1',
        'code2',
        'penerima',
        'pemberi',
    ];
}
