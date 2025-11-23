@extends('master')
@section('title', 'Daftar Pegawai')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Pegawai</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola pegawai dalam perusahaan</p>
        </div>
        <a href="{{ route('admin.employees.create') }}">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Pegawai</span>
            </button>
        </a>
    </div>

    <div class="mb-6">
        <form method="GET" action="{{ route('admin.employees.index') }}" class="flex items-center gap-2 w-full">
            <input
                id="q"
                name="q"
                type="search"
                value="{{ request('q') }}"
                placeholder="Cari nama, departemen, atau jabatan..."
                class="flex-1 w-full px-4 py-3 border border-gray-300 rounded-lg
                    focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
            />

            <button type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-sm transition-all duration-300">
                Cari
            </button>

            @if(request()->filled('q'))
                <a href="{{ route('admin.employees.index') }}"
                class="px-4 py-3 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm font-medium">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama Lengkap</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nomor Telepon</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal Lahir</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Alamat</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal Masuk</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Departemen</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Jabatan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($employees as $employee)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-4 py-3 text-sm text-gray-800">{{ $employee->nama_lengkap }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $employee->email }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $employee->nomor_telepon }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $employee->tanggal_lahir }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $employee->alamat }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $employee->tanggal_masuk }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $employee->department->nama_departemen ?? 'Tidak Ditemukan' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $employee->position->nama_jabatan ?? 'Tidak Ditemukan' }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.employees.show', $employee->id) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            
                            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="text-yellow-600 hover:text-yellow-800 transition-colors duration-200" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            
                            <button type="button" onclick="openDeleteModal({{ $employee->id }}, '{{ $employee->nama_lengkap }}')" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center space-y-3">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="text-lg font-medium">Belum ada data pegawai</p>
                            <p class="text-sm">Silakan tambah pegawai baru dengan menekan tombol di atas</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end items-center">
        <div>
            {{ $employees->links() }}
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
                <h3 class="text-lg font-bold text-gray-900">Hapus Pegawai</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Apakah Anda yakin ingin menghapus pegawai <span id="employeeName" class="font-semibold text-gray-900"></span>?
                </p>
                <p class="mt-1 text-sm text-red-600 leading-relaxed">
                    Menghapus data pegawai juga akan <span class="font-semibold">menghapus akun login</span> 
                    yang terkait dengan pegawai ini (jika ada), dan tindakan ini 
                    <span class="font-semibold">tidak dapat dibatalkan!</span>
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
    function openDeleteModal(employeeId, employeeName) {
        const modal = document.getElementById('deleteModal');
        document.getElementById('employeeName').textContent = employeeName;
        document.getElementById('deleteForm').action = '/admin/employees/' + employeeId;
        
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