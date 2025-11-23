@extends('master')
@section('title', 'Buat Akun User Pegawai')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-xl mx-auto">
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Buat Akun Pengguna</h2>
        <p class="text-gray-600 text-sm mt-1">
            Pegawai: <span class="font-semibold">{{ $employee->nama_lengkap }}</span>
        </p>
    </div>

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
            {{ session('error') }}
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

    <form action="{{ route('admin.employees.store-user', $employee->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nama Pegawai
            </label>
            <input type="text" value="{{ $employee->nama_lengkap }}" disabled
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg bg-gray-50 text-sm text-gray-700">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email untuk Login
            </label>
            <input id="email" type="email" name="email"
                   value="{{ old('email', $employee->email) }}"
                   required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <p class="mt-1 text-xs text-gray-500">
                Bisa gunakan email pegawai atau email khusus login.
            </p>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Kata Sandi
            </label>
            <input id="password" type="password" name="password" required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Konfirmasi Kata Sandi
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="flex justify-between items-center pt-2">
            <a href="{{ route('admin.employees.show', $employee->id) }}"
               class="text-sm text-gray-600 hover:text-gray-800">
                ← Kembali ke detail pegawai
            </a>

            <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg
                           shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200">
                Buat Akun
            </button>
        </div>
    </form>
</div>
@endsection
