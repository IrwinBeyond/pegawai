@extends('master')
@section('title', 'Daftar Kehadiran')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-7xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Kehadiran Pegawai</h2>
        <p class="text-gray-600 text-sm mt-1">Kelola data kehadiran dan absensi pegawai</p>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama Pegawai</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Waktu Masuk</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Waktu Keluar</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($attendances as $attendance)
                <tr class="hover:bg-gray-50 transition-colors duration-200" id="row-{{ $attendance->id }}">
                    <td class="px-4 py-3">
                        <div class="text-sm text-gray-800 font-medium">{{ $attendance->employee->nama_lengkap ?? '-' }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <div id="display-{{ $attendance->id }}">
                            <div class="text-sm text-gray-600">{{ $attendance->tanggal }}</div>
                        </div>
                        
                        <form action="{{ route('admin.attendances.update', $attendance->id) }}" method="POST" id="edit-form-{{ $attendance->id }}" class="hidden">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center space-x-2">
                                <input type="time" 
                                       name="waktu_masuk" 
                                       value="{{ $attendance->waktu_masuk }}"
                                       class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                                       placeholder="Masuk">
                                <input type="time" 
                                       name="waktu_keluar" 
                                       value="{{ $attendance->waktu_keluar }}"
                                       class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                                       placeholder="Keluar">
                                <select name="status_absensi" 
                                        required
                                        class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                                    <option value="hadir" {{ $attendance->status_absensi == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="izin" {{ $attendance->status_absensi == 'izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="sakit" {{ $attendance->status_absensi == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="alpha" {{ $attendance->status_absensi == 'alpha' ? 'selected' : '' }}>Alfa</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-all duration-200 whitespace-nowrap">
                                    Simpan
                                </button>
                                <button type="button" onclick="cancelEdit({{ $attendance->id }})" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold rounded-lg transition-all duration-200 whitespace-nowrap">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <div id="time-display-{{ $attendance->id }}" class="text-sm text-gray-600">
                            {{ $attendance->waktu_masuk ?? '-' }}
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div id="checkout-display-{{ $attendance->id }}" class="text-sm text-gray-600">
                            {{ $attendance->waktu_keluar ?? '-' }}
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div id="status-display-{{ $attendance->id }}">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $attendance->status_absensi == 'hadir' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $attendance->status_absensi == 'izin' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $attendance->status_absensi == 'sakit' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $attendance->status_absensi == 'alpha' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($attendance->status_absensi) }}
                            </span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center space-x-2" id="actions-{{ $attendance->id }}">
                            <button type="button" onclick="editMode({{ $attendance->id }})" class="text-yellow-600 hover:text-yellow-800 transition-colors duration-200" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            
                            <button type="button" onclick="openDeleteModal({{ $attendance->id }}, '{{ $attendance->employee->nama_lengkap ?? 'Data' }}', '{{ $attendance->tanggal }}')" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center space-y-3">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <p class="text-lg font-medium">Belum ada data kehadiran</p>
                            <p class="text-sm">Silakan tambah data kehadiran menggunakan form di atas</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end items-center">
        <div>
            {{ $attendances->links() }}
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
                <h3 class="text-lg font-bold text-gray-900">Hapus Data Kehadiran</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Apakah Anda yakin ingin menghapus data kehadiran <span id="employeeName" class="font-semibold text-gray-900"></span> pada tanggal <span id="attendanceDate" class="font-semibold text-gray-900"></span>?
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
        document.getElementById('time-display-' + id).classList.add('hidden');
        document.getElementById('checkout-display-' + id).classList.add('hidden');
        document.getElementById('status-display-' + id).classList.add('hidden');
        document.getElementById('edit-form-' + id).classList.remove('hidden');
        document.getElementById('actions-' + id).classList.add('hidden');
    }

    function cancelEdit(id) {
        document.getElementById('display-' + id).classList.remove('hidden');
        document.getElementById('time-display-' + id).classList.remove('hidden');
        document.getElementById('checkout-display-' + id).classList.remove('hidden');
        document.getElementById('status-display-' + id).classList.remove('hidden');
        document.getElementById('edit-form-' + id).classList.add('hidden');
        document.getElementById('actions-' + id).classList.remove('hidden');
    }

    function openDeleteModal(attendanceId, employeeName, attendanceDate) {
        const modal = document.getElementById('deleteModal');
        document.getElementById('employeeName').textContent = employeeName;
        document.getElementById('attendanceDate').textContent = attendanceDate;
        document.getElementById('deleteForm').action = '/admin/attendances/' + attendanceId;
        
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