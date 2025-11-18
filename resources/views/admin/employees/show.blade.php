@extends('master')
@section('title', 'Detail Pegawai')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Pegawai</h2>
            <p class="text-gray-600 text-sm mt-1">Informasi lengkap data pegawai</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.employees.edit', $employee->id) }}">
                <button class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit</span>
                </button>
            </a>
            <a href="{{ route('admin.employees.index') }}">
                <button class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali</span>
                </button>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Nama Lengkap</p>
                    <p class="text-gray-800 font-semibold text-lg">{{ $employee->nama_lengkap }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Email</p>
                    <p class="text-gray-800 font-medium">{{ $employee->email }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Nomor Telepon</p>
                    <p class="text-gray-800 font-medium">{{ $employee->nomor_telepon }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Tanggal Lahir</p>
                    <p class="text-gray-800 font-medium">{{ $employee->tanggal_lahir }}</p>
                </div>
            </div>
        </div>

        <div class="md:col-span-2 bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Alamat</p>
                    <p class="text-gray-800 font-medium">{{ $employee->alamat }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Tanggal Masuk</p>
                    <p class="text-gray-800 font-medium">{{ $employee->tanggal_masuk }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($employee->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Departemen</p>
                    <p class="text-gray-800 font-medium">{{ $employee->department->nama_departemen ?? 'Tidak Ditemukan' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-blue-300 transition-colors duration-200">
            <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Jabatan</p>
                    <p class="text-gray-800 font-medium">{{ $employee->position->nama_jabatan ?? 'Tidak Ditemukan' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Informasi Akun Login</h3>
                <p class="text-xs text-gray-500">
                    Akun yang digunakan pegawai ini untuk mengakses portal karyawan.
                </p>
            </div>

            @if ($employee->user)
                <a href="{{ route('admin.employees.edit-user', $employee->id) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold rounded-lg shadow-sm transition-all duration-200">
                    Edit Akun Login
                </a>
            @endif
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-dashed border-gray-300">
            @if (!$employee->user)
                <p class="text-sm text-gray-700 mb-3">
                    Pegawai ini <span class="font-semibold text-red-600">belum memiliki akun login</span>.
                </p>
                <div class="flex justify-end">
                    <a href="{{ route('admin.employees.create-user', $employee->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 transition-all duration-200">
                        Buat Akun Login
                    </a>
                </div>
            @else
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase mb-1">Email Login</dt>
                        <dd class="font-mono text-gray-900 break-all">{{ $employee->user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase mb-1">Role</dt>
                        <dd class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                            {{ $employee->user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($employee->user->role) }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase mb-1">Dibuat Pada</dt>
                        <dd class="text-gray-800">
                            {{ optional($employee->user->created_at)->format('d M Y H:i') ?? '-' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase mb-1">Terakhir Diperbarui</dt>
                        <dd class="text-gray-800">
                            {{ optional($employee->user->updated_at)->format('d M Y H:i') ?? '-' }}
                        </dd>
                    </div>
                </dl>
            @endif
        </div>
    </div>
</div>
@endsection
