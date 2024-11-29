<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportDataProyeks;

class DataProyekComponent extends Component
{
    use WithFileUploads;

    public $file;

    public function importData()
    {
        if ($this->file) {
            // Validasi file
            $this->validate([
                'file' => 'required|file|mimes:xlsx,csv',
            ]);

            // Proses import
            Excel::import(new ImportDataProyeks, $this->file->getRealPath());

            // Reset input file
            $this->file = null;

            // Kirim notifikasi sukses
            session()->flash('success', 'Data berhasil diimpor!');
        } else {
            session()->flash('error', 'Harap pilih file sebelum mengunggah!');
        }
    }

    public function render()
    {
        return view('livewire.data-proyek-component');
    }
}


