@extends('master')
@section('title', 'Daftar Jabatan')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-5xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Jabatan</h2>
        <p class="text-gray-600 text-sm mt-1">Kelola jabatan dan gaji pokok dalam perusahaan</p>
    </div>

    <form action="{{ route('positions.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="md:col-span-1">
                <label for="nama_jabatan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Jabatan <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_jabatan" 
                       name="nama_jabatan" 
                       required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="Contoh: Manager">
            </div>
            <div class="md:col-span-1">
                <label for="gaji_pokok" class="block text-sm font-semibold text-gray-700 mb-2">
                    Gaji Pokok <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       id="gaji_pokok" 
                       name="gaji_pokok" 
                       required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="5000000">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
    </form>

    <div class="border-t border-gray-200 my-6"></div>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama Jabatan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Gaji Pokok</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($positions as $position)
                <tr class="hover:bg-gray-50 transition-colors duration-200" id="row-{{ $position->id }}">
                    <td class="px-4 py-3">
                        <div id="display-{{ $position->id }}">
                            <div class="text-sm text-gray-800 font-medium">{{ $position->nama_jabatan }}</div>
                        </div>
                        
                        <form action="{{ route('positions.update', $position->id) }}" method="POST" id="edit-form-{{ $position->id }}" class="hidden">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       name="nama_jabatan" 
                                       value="{{ $position->nama_jabatan }}" 
                                       required
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                                       placeholder="Nama Jabatan">
                                <input type="number" 
                                       name="gaji_pokok" 
                                       value="{{ $position->gaji_pokok }}" 
                                       required
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                                       placeholder="Gaji Pokok">
                                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-all duration-200 whitespace-nowrap">
                                    Simpan
                                </button>
                                <button type="button" onclick="cancelEdit({{ $position->id }})" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 whitespace-nowrap">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <div id="salary-display-{{ $position->id }}" class="text-sm text-gray-600">
                            Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center space-x-2" id="actions-{{ $position->id }}">
                            <button type="button" onclick="editMode({{ $position->id }})" class="text-yellow-600 hover:text-yellow-800 transition-colors duration-200" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            
                            <button type="button" onclick="openDeleteModal({{ $position->id }}, '{{ $position->nama_jabatan }}')" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center space-y-3">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-lg font-medium">Belum ada data jabatan</p>
                            <p class="text-sm">Silakan tambah jabatan baru menggunakan form di atas</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end items-center">
        <div>
            {{ $positions->links() }}
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center opacity-0 pointer-events-none">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            
            <div class="mt-4 text-center">
                <h3 class="text-lg font-bold text-gray-900">Hapus Jabatan</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Apakah Anda yakin ingin menghapus jabatan <span id="positionName" class="font-semibold text-gray-900"></span>?
                </p>
                <p class="mt-1 text-sm text-red-600">
                    Data yang sudah dihapus tidak dapat dikembalikan!
                </p>
            </div>

            <div class="mt-6 flex space-x-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-all duration-200">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all duration-200">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #deleteModal {
        transition: opacity 0.3s ease-in-out;
    }
    
    #deleteModal.show {
        opacity: 1;
    }
    
    #deleteModal > div {
        transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        transform: scale(0.95);
        opacity: 0;
    }
    
    #deleteModal.show > div {
        transform: scale(1);
        opacity: 1;
    }
</style>

<script>
    function editMode(id) {
        document.getElementById('display-' + id).classList.add('hidden');
        document.getElementById('salary-display-' + id).classList.add('hidden');
        document.getElementById('edit-form-' + id).classList.remove('hidden');
        document.getElementById('actions-' + id).classList.add('hidden');
    }

    function cancelEdit(id) {
        document.getElementById('display-' + id).classList.remove('hidden');
        document.getElementById('salary-display-' + id).classList.remove('hidden');
        document.getElementById('edit-form-' + id).classList.add('hidden');
        document.getElementById('actions-' + id).classList.remove('hidden');
    }

    function openDeleteModal(positionId, positionName) {
        const modal = document.getElementById('deleteModal');
        document.getElementById('positionName').textContent = positionName;
        document.getElementById('deleteForm').action = '/positions/' + positionId;
        
        modal.classList.remove('pointer-events-none');
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.classList.add('pointer-events-none');
        }, 300);
    }

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endsection