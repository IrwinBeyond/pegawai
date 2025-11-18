@extends('master')
@section('title', 'Edit Akun Login Pegawai')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-xl mx-auto">
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Edit Akun Login</h2>
        <p class="text-gray-600 text-sm mt-1">
            Pegawai: <span class="font-semibold">{{ $employee->nama_lengkap }}</span>
        </p>
    </div>

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.employees.update-user', $employee->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nama Pegawai
            </label>
            <input type="text" value="{{ $employee->nama_lengkap }}" disabled
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-sm text-gray-700">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email Login
            </label>
            <input id="email" type="email" name="email"
                   value="{{ old('email', $user->email) }}" required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="border-t border-gray-200 pt-4 mt-2">
            <p class="text-xs text-gray-500 mb-2">
                Kosongkan kolom di bawah ini jika tidak ingin mengganti kata sandi.
            </p>

            <div class="space-y-3">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Kata Sandi Baru <span class="text-xs text-gray-400">(opsional)</span>
                    </label>
                    <input id="password" type="password" name="password"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('admin.employees.show', $employee->id) }}"
               class="text-sm text-gray-600 hover:text-gray-800">
                ← Kembali ke detail pegawai
            </a>

            <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg
                           shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
