@extends('layouts.auth')
@section('title', 'Lupa Kata Sandi - App Pegawai')
@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-1 text-center">Lupa Kata Sandi</h1>
    <p class="text-sm text-gray-500 mb-6 text-center">
        Masukkan email Anda, kami akan mengirimkan link untuk mengatur ulang kata sandi.
    </p>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
            {{ session('status') }}
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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Alamat Email
            </label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="pt-2">
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg
                           shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200">
                Kirim Link Reset Kata Sandi
            </button>
        </div>
    </form>

    <p class="mt-4 text-center text-xs text-gray-500">
        Kembali ke
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
            halaman login
        </a>
    </p>
@endsection
