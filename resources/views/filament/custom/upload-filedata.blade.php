<style>
    /* Wrapper untuk input file dan tombol unggah */
    .file-upload-wrapper {
        display: flex;
        width: 100%;
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    /* Gaya untuk input file */
    .file-upload-input {
        border-right: 0; /* Hilangkan border kanan */
        font-size: 14px;
        font-family: 'Roboto', sans-serif;
        background-color: #f9fafb; /* Warna latar belakang lembut */
        padding: 12px 15px;
        width: 100%; /* Mengisi lebar */
    }

    /* Saat input file fokus */
    .file-upload-input:focus {
        border-color: #6366f1; /* Warna biru terang saat fokus */
        outline: none;
        box-shadow: 0 0 5px rgba(99, 102, 241, 0.5); /* Efek bayangan saat fokus */
    }

    /* Gaya untuk tombol unggah */
    .submit-btn {
        background-color: #1F1C69; /* Warna ungu gelap */
        color: white;
        font-weight: bold;
        font-size: 14px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        padding: 12px 18px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    /* Efek hover pada tombol unggah */
    .submit-btn:hover {
        background-color: #6366f1; /* Warna biru terang saat hover */
    }

    /* Gaya untuk label */
    label {
        font-size: 14px;
        font-weight: 600;
        color: #4b5563; /* Warna teks label */
        margin-bottom: 8px;
    }

    /* Responsif untuk ukuran layar lebih kecil */
    @media (max-width: 768px) {
        .submit-btn {
            font-size: 14px;
            padding: 10px 16px;
        }

        .file-upload-input {
            font-size: 12px;
            padding: 10px 12px;
        }
    }
</style>

<div>
    <x-filament::breadcrumbs :breadcrumbs="[ '/admin/data-proyeks' => 'Data Proyek', '' => 'List Data Proyek', ]" />
    <div class="flex justify-between mt-1">
        <div class="font-bold text-3xl">Data Proyeks</div>
        <div>
            {{ $dataproyek }}
        </div>
    </div>
    <div class="mt-4">
        <form wire:submit.prevent="save" class="w-full max-w-sm flex mt-2">
            <div class="mb-4 w-full">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fileInput">
                    Pilih File
                </label>
                <div class="file-upload-wrapper">
                    <input 
                        class="file-upload-input shadow appearance-none border rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="fileInput" 
                        type="file" 
                        wire:model="file">
                        
                    <button 
                        class="submit-btn rounded-r py-2 px-6" 
                        type="submit">
                        Unggah
                    </button>
                </div>
                <!-- Menampilkan teks "Process Import" saat proses berjalan -->
                <div wire:loading wire:target="save" class="text-blue-500 mt-2">
                    Process Import...
                </div>
            </div>
        </form>
    </div>
</div>
