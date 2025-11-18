@extends('master')
@section('title', 'Absensi Saya')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-5xl mx-auto">
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Absensi Pegawai</h2>
            <p class="text-gray-600 text-sm mt-1">
                Halo, <span class="font-semibold">{{ $employee->nama_lengkap }}</span>.
                Kelola kehadiranmu di sini.
            </p>
        </div>
        <div class="text-sm text-gray-600">
            <p>Hari ini:</p>
            <p class="font-semibold text-gray-900">{{ now()->translatedFormat('l, d M Y') }}</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-8 p-4 border rounded-lg bg-gray-50">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">Status absensi hari ini</p>

                @if (!$todayAttendance)
                    <p class="text-lg font-semibold text-red-600">
                        Belum absen
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Silakan lakukan check-in ketika mulai bekerja.
                    </p>
                @else
                    @if ($todayAttendance->waktu_masuk && !$todayAttendance->waktu_keluar)
                        <p class="text-lg font-semibold text-yellow-600">
                            Sudah Check-in ({{ $todayAttendance->waktu_masuk }})
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Jangan lupa check-out ketika selesai bekerja.
                        </p>
                    @elseif ($todayAttendance->waktu_masuk && $todayAttendance->waktu_keluar)
                        <p class="text-lg font-semibold text-green-600">
                            Selesai ({{ $todayAttendance->waktu_masuk }} – {{ $todayAttendance->waktu_keluar }})
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Terima kasih, absensi untuk hari ini sudah lengkap.
                        </p>
                    @else
                        <p class="text-lg font-semibold text-gray-700">
                            {{ ucfirst($todayAttendance->status_absensi ?? 'hadir') }}
                        </p>
                    @endif
                @endif
            </div>

            <div class="flex flex-wrap gap-3">
                @php
                    $disableCheckIn = $todayAttendance && $todayAttendance->waktu_masuk;
                    $disableCheckOut = !$todayAttendance || !$todayAttendance->waktu_masuk || $todayAttendance->waktu_keluar;
                @endphp

                <form action="{{ route('employee.attendances.checkin') }}" method="POST">
                    @csrf
                    <button type="submit"
                        @if($disableCheckIn) disabled @endif
                        class="px-5 py-2.5 rounded-lg font-semibold text-white
                               @if($disableCheckIn)
                                   bg-gray-400 cursor-not-allowed
                               @else
                                   bg-green-600 hover:bg-green-700
                               @endif
                               shadow-sm hover:shadow-md transition-all duration-200">
                        Check-In
                    </button>
                </form>

                <form action="{{ route('employee.attendances.checkout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        @if($disableCheckOut) disabled @endif
                        class="px-5 py-2.5 rounded-lg font-semibold text-white
                               @if($disableCheckOut)
                                   bg-gray-400 cursor-not-allowed
                               @else
                                   bg-blue-600 hover:bg-blue-700
                               @endif
                               shadow-sm hover:shadow-md transition-all duration-200">
                        Check-Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            Riwayat Absensi (30 hari terakhir)
        </h3>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-blue-600 text-white text-sm">
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Masuk</th>
                        <th class="px-4 py-2 text-left">Keluar</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse ($attendances as $a)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $a->tanggal }}</td>
                            <td class="px-4 py-2">{{ $a->waktu_masuk ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $a->waktu_keluar ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($a->status_absensi === 'hadir') bg-green-100 text-green-800 @endif
                                    @if($a->status_absensi === 'izin') bg-blue-100 text-blue-800 @endif
                                    @if($a->status_absensi === 'sakit') bg-yellow-100 text-yellow-800 @endif
                                    @if($a->status_absensi === 'alpha') bg-red-100 text-red-800 @endif
                                ">
                                    {{ ucfirst($a->status_absensi ?? 'hadir') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                Belum ada data absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
