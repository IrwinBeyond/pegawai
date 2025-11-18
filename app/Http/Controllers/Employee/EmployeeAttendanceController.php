<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $employee = $user->employee;

        if (!$employee) {
            abort(403, 'Akun ini tidak terhubung dengan data karyawan.');
        }

        $today = now()->toDateString();

        $todayAttendance = Attendance::where('karyawan_id', $employee->id)
            ->where('tanggal', $today)
            ->first();

        $attendances = Attendance::where('karyawan_id', $employee->id)
            ->orderByDesc('tanggal')
            ->limit(30)
            ->get();

        return view('employee.attendance.index', compact(
            'employee',
            'todayAttendance',
            'attendances'
        ));
    }

    public function checkIn(Request $request)
    {
        $user = auth()->user();
        $employee = $user->employee;

        if (!$employee) {
            abort(403, 'Akun ini tidak terhubung dengan data karyawan.');
        }

        $today = now()->toDateString();

        $attendance = Attendance::where('karyawan_id', $employee->id)
            ->where('tanggal', $today)
            ->first();

        if ($attendance && $attendance->waktu_masuk) {
            return back()->with('error', 'Anda sudah melakukan check-in hari ini.');
        }

        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->karyawan_id = $employee->id;
            $attendance->tanggal = $today;
        }

        $attendance->waktu_masuk = now()->format('H:i');
        // default status ke hadir jika belum ada
        if (!$attendance->status_absensi) {
            $attendance->status_absensi = 'hadir';
        }
        $attendance->save();

        return back()->with('success', 'Check-in berhasil.');
    }

    public function checkOut(Request $request)
    {
        $user = auth()->user();
        $employee = $user->employee;

        if (!$employee) {
            abort(403, 'Akun ini tidak terhubung dengan data karyawan.');
        }

        $today = now()->toDateString();

        $attendance = Attendance::where('karyawan_id', $employee->id)
            ->where('tanggal', $today)
            ->first();

        if (!$attendance || !$attendance->waktu_masuk) {
            return back()->with('error', 'Anda belum melakukan check-in hari ini.');
        }

        if ($attendance->waktu_keluar) {
            return back()->with('error', 'Anda sudah melakukan check-out hari ini.');
        }

        $attendance->waktu_keluar = now()->format('H:i');
        $attendance->save();

        return back()->with('success', 'Check-out berhasil.');
    }
}
