@extends('layouts.auth')
@section('title', 'Daftar - App Pegawai')
@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-1 text-center">Daftar Akun</h1>
    <p class="text-sm text-gray-500 mb-6 text-center">
        Buat akun untuk mengakses sistem kepegawaian.
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

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Lengkap
            </label>
            <input id="name" type="text" name="name"
                   value="{{ old('name') }}" required autofocus
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Alamat Email
            </label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}" required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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

        <div class="pt-2">
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg
                           shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200">
                Daftar
            </button>
        </div>
    </form>

    @if (Route::has('login'))
        <p class="mt-4 text-center text-xs text-gray-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                Masuk di sini
            </a>
        </p>
    @endif
@endsection
