<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masuk - App Pegawai')</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/pegawai-logo.png') }}">
    @vite('resources/css/app.css')

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-animate {
            animation: fade-in 0.4s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="text-center mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center">
                    <span class="text-white text-3xl font-bold italic drop-shadow-lg tracking-wide">
                        PEGAWAI
                    </span>
                </a>
                <p class="text-blue-100 text-sm mt-1">
                    Employee Management System
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl card-animate p-6 sm:p-8">
                @yield('content')
            </div>

            <p class="mt-6 text-center text-xs text-blue-100">
                &copy; {{ date('Y') }} App Pegawai. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
