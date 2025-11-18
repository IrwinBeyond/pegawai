@extends('master')
@section('title', 'Edit Pegawai')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Pegawai</h2>
        <p class="text-gray-600 text-sm mt-1">Perbarui informasi pegawai yang sudah ada</p>
    </div>

    <!-- Form Section -->
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_lengkap" 
                       name="nama_lengkap" 
                       value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" 
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="Masukkan nama lengkap">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $employee->email) }}" 
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="contoh@email.com">
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label for="nomor_telepon" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nomor Telepon <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nomor_telepon" 
                       name="nomor_telepon" 
                       value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" 
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="08123456789">
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Lahir <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       id="tanggal_lahir" 
                       name="tanggal_lahir" 
                       value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" 
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            </div>

            <!-- Alamat (Full Width) -->
            <div class="md:col-span-2">
                <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea id="alamat" 
                          name="alamat" 
                          rows="3" 
                          required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                          placeholder="Masukkan alamat lengkap">{{ old('alamat', $employee->alamat) }}</textarea>
            </div>

            <!-- Departemen -->
            <div>
                <label for="departemen_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Departemen <span class="text-red-500">*</span>
                </label>
                <select id="departemen_id" 
                        name="departemen_id" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">-- Pilih Departemen --</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('departemen_id', $employee->departemen_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->nama_departemen }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jabatan -->
            <div>
                <label for="jabatan_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Jabatan <span class="text-red-500">*</span>
                </label>
                <select id="jabatan_id" 
                        name="jabatan_id" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('jabatan_id', $employee->jabatan_id) == $position->id ? 'selected' : '' }}>
                            {{ $position->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Masuk -->
            <div>
                <label for="tanggal_masuk" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Masuk <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       id="tanggal_masuk" 
                       name="tanggal_masuk" 
                       value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" 
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" 
                        name="status" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option value="Aktif" {{ old('status', $employee->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ old('status', $employee->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

        </div>

        <!-- Button Section -->
        <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('employees.index') }}">
                <button type="button" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Batal
                </button>
            </a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>Update Data</span>
            </button>
        </div>

    </form>
</div>
@endsection