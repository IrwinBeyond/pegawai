@extends('master')
@section('title', 'Tambah Data Gaji')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Data Gaji Pegawai</h2>
        <p class="text-gray-600 text-sm mt-1">Lengkapi form di bawah untuk menambahkan data gaji pegawai</p>
    </div>

    <form action="{{ route('admin.salaries.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="karyawan_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Pegawai <span class="text-red-500">*</span>
                </label>
                <select id="karyawan_id" 
                        name="karyawan_id" 
                        required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }} (Gaji Pokok: Rp {{ number_format($employee->position->gaji_pokok, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Pilih pegawai yang akan diberikan gaji (gaji pokok otomatis sesuai jabatan)</p>
            </div>

            <div>
                <label for="bulan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Bulan <span class="text-red-500">*</span>
                </label>
                <select id="bulan" 
                        name="bulan" 
                        required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">-- Pilih Bulan --</option>
                    @foreach ([
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ] as $bulan)
                        <option value="{{ $bulan }}" {{ old('bulan') == $bulan ? 'selected' : '' }}>
                            {{ $bulan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div></div>

            <div>
                <label for="tunjangan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tunjangan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-2.5 text-gray-500 font-medium">Rp</span>
                    <input type="number" 
                           id="tunjangan" 
                           name="tunjangan" 
                           min="0" 
                           step="1" 
                           value="{{ old('tunjangan', 0) }}" 
                           required
                           class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                           placeholder="0">
                </div>
                <p class="text-xs text-green-600 mt-1">Tambahan penghasilan (bonus, insentif, dll)</p>
            </div>

            <div>
                <label for="potongan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Potongan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-2.5 text-gray-500 font-medium">Rp</span>
                    <input type="number" 
                           id="potongan" 
                           name="potongan" 
                           min="0" 
                           step="1" 
                           value="{{ old('potongan', 0) }}" 
                           required
                           class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                           placeholder="0">
                </div>
                <p class="text-xs text-red-600 mt-1">Pengurangan gaji (pajak, pinjaman, dll)</p>
            </div>
        </div>

        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900">Informasi Perhitungan Gaji</p>
                    <p class="text-xs text-blue-700 mt-1">Total Gaji = Gaji Pokok + Tunjangan - Potongan</p>
                    <p class="text-xs text-blue-700">Gaji pokok akan otomatis diambil dari data jabatan pegawai yang dipilih.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.salaries.index') }}">
                <button type="button" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </button>
            </a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Simpan Data</span>
            </button>
        </div>
    </form>
</div>
@endsection