@extends('layouts.auth')
@section('title', 'Verifikasi Email - App Pegawai')
@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-1 text-center">Verifikasi Alamat Email</h1>
    <p class="text-sm text-gray-500 mb-4 text-center">
        Sebelum melanjutkan, silakan verifikasi alamat email Anda melalui link yang telah kami kirimkan.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
            Link verifikasi baru telah dikirim ke alamat email Anda.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
        @csrf

        <button type="submit"
                class="w-full px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg
                       shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200">
            Kirim Ulang Link Verifikasi
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit"
                class="w-full px-4 py-2.5 bg-gray-200 text-gray-800 font-semibold rounded-lg
                       hover:bg-gray-300 transition-all duration-200 text-sm">
            Logout
        </button>
    </form>
@endsection
