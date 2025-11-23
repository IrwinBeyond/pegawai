<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = $user->employee()->with(['department', 'position'])->firstOrFail();

        $today = now()->toDateString();

        $todayAttendance = Attendance::where('karyawan_id', $employee->id)
            ->where('tanggal', $today)
            ->first();

        $salaries = Salary::where('karyawan_id', $employee->id)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('employee.index', compact('employee', 'todayAttendance', 'salaries'));
    }
}
