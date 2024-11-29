<div>
    <form wire:submit.prevent="importData" class="w-full max-w-sm flex mt-2">
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
            <div wire:loading wire:target="file" class="text-blue-500 mt-2">
                Process Import...
            </div>
        </div>
    </form>

    <!-- Notifikasi -->
    @if (session()->has('success'))
        <div class="text-green-500 mt-2">{{ session('success') }}</div>
    @elseif (session()->has('error'))
        <div class="text-red-500 mt-2">{{ session('error') }}</div>
    @endif
</div>
