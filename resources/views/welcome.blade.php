<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - App Pegawai</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/images/pegawai-logo.png') }}">
    @vite('resources/css/app.css')
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <div class="mb-10 animate-fade-in">
                <h1 class="text-7xl font-bold text-white italic mb-4 drop-shadow-2xl">
                    PEGAWAI
                </h1>
                <p class="text-blue-100 text-xl mb-6">
                    Employee Management System untuk kebutuhan kepegawaian modern.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center px-6 py-3 rounded-full bg-white text-blue-700 font-semibold shadow-lg hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-300">
                            Masuk
                        </a>
                    @endif
                </div>

                <p class="mt-4 text-blue-100 text-sm">
                    Login sebagai <span class="font-semibold">Admin</span> untuk mengelola data,<br>
                    atau sebagai <span class="font-semibold">Pegawai</span> untuk melakukan absensi mandiri.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="bg-blue-100 p-4 rounded-full">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Manajemen Pegawai</h3>
                            <p class="text-gray-500 text-sm mt-1">
                                Simpan dan kelola data pegawai secara terpusat dan rapi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="bg-blue-100 p-4 rounded-full">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Absensi Digital</h3>
                            <p class="text-gray-500 text-sm mt-1">
                                Pegawai dapat melakukan check-in & check-out secara mandiri.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="bg-blue-100 p-4 rounded-full">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Struktur Organisasi</h3>
                            <p class="text-gray-500 text-sm mt-1">
                                Atur departemen dan jabatan untuk mencerminkan struktur organisasi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="bg-blue-100 p-4 rounded-full">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Rekap Gaji</h3>
                            <p class="text-gray-500 text-sm mt-1">
                                Catat gaji pokok, tunjangan, dan potongan dalam satu sistem.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <p class="text-blue-100 text-sm">
                    &copy; {{ date('Y') }} App Pegawai. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
