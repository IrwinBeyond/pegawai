@extends('layouts.auth')
@section('title', 'Konfirmasi Kata Sandi - App Pegawai')
@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-1 text-center">Konfirmasi Kata Sandi</h1>
    <p class="text-sm text-gray-500 mb-6 text-center">
        Demi keamanan, silakan masukkan kembali kata sandi Anda sebelum melanjutkan.
    </p>

    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Kata Sandi
            </label>
            <input id="password" type="password" name="password" required autofocus
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="pt-2">
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg
                           shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200">
                Konfirmasi
            </button>
        </div>
    </form>
@endsection
