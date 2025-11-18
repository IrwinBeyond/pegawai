@extends('master')
@section('title', 'Dashboard Pegawai')
@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pegawai</h1>
            <p class="text-gray-600 text-sm mt-1">
                Selamat datang, <span class="font-semibold">{{ $employee->nama_lengkap }}</span>.
            </p>
        </div>
        <div class="text-sm text-gray-600 text-right">
            <p>Hari ini</p>
            <p class="font-semibold text-gray-900">
                {{ now()->translatedFormat('l, d M Y') }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-white rounded-lg shadow-md p-5">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Quick Attendance</h2>

            @if (session('success'))
                <div class="mb-3 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-3 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-4 p-3 rounded-lg bg-gray-50 border">
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

            @php
                $disableCheckIn = $todayAttendance && $todayAttendance->waktu_masuk;
                $disableCheckOut = !$todayAttendance || !$todayAttendance->waktu_masuk || $todayAttendance->waktu_keluar;
            @endphp

            <div class="flex flex-wrap gap-3">
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

                <a href="{{ route('employee.attendances.index') }}"
                   class="px-5 py-2.5 rounded-lg text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 shadow-sm transition-all duration-200">
                    Lihat Detail Absensi
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-5">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Profil Singkat</h2>

            <div class="space-y-2 text-sm text-gray-700">
                <div>
                    <p class="text-gray-500">Nama Lengkap</p>
                    <p class="font-semibold text-gray-900">{{ $employee->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Email</p>
                    <p class="font-mono text-gray-900 text-xs break-all">{{ $employee->email }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Departemen</p>
                    <p class="font-semibold text-gray-900">
                        {{ $employee->department->nama_departemen ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-500">Jabatan</p>
                    <p class="font-semibold text-gray-900">
                        {{ $employee->position->nama_jabatan ?? '-' }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <div>
                        <p class="text-gray-500 text-xs">Tanggal Masuk</p>
                        <p class="text-sm font-semibold text-gray-900">
                            {{ \Illuminate\Support\Carbon::parse($employee->tanggal_masuk)->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs">Status</p>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                            {{ $employee->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-5">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-semibold text-gray-800">Riwayat Gaji</h2>
            <p class="text-xs text-gray-500">Menampilkan beberapa gaji terakhir</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-blue-600 text-white text-sm">
                        <th class="px-4 py-2 text-left">Bulan</th>
                        <th class="px-4 py-2 text-right">Gaji Pokok</th>
                        <th class="px-4 py-2 text-right">Tunjangan</th>
                        <th class="px-4 py-2 text-right">Potongan</th>
                        <th class="px-4 py-2 text-right">Total Gaji</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @forelse ($salaries as $salary)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $salary->bulan }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-right font-semibold">
                                Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                Belum ada data gaji yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
