@extends('layouts.auth')
@section('title', 'Masuk - App Pegawai')
@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-1 text-center">Masuk</h1>
    <p class="text-sm text-gray-500 mb-6 text-center">
        Silakan login untuk mengakses sistem kepegawaian.
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

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
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

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Kata Sandi
            </label>
            <input id="password" type="password" name="password" required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="remember"
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <span class="text-gray-700">Ingat saya</span>
            </label>

            <!-- @if (Route::has('password.request'))
                <a class="text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif -->
        </div>

        <div class="pt-2">
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg
                           shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200">
                Masuk
            </button>
        </div>
    </form>

    <!-- @if (Route::has('register'))
        <p class="mt-4 text-center text-xs text-gray-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                Daftar sekarang
            </a>
        </p>
    @endif -->
@endsection
