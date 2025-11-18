<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard login redirect
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('employees.index');
    }
    return redirect()->route('employee.attendances.index');
})->middleware(['auth'])->name('dashboard');

// Admin Only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('salaries', SalaryController::class);
    Route::resource('attendances', AttendanceController::class);
});

// EMPLOYEE ONLY
Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::get('attendance', [EmployeeAttendanceController::class, 'index'])
            ->name('attendance.index');

        Route::post('attendance/check-in', [EmployeeAttendanceController::class, 'checkIn'])
            ->name('attendance.checkin');

        Route::post('attendance/check-out', [EmployeeAttendanceController::class, 'checkOut'])
            ->name('attendance.checkout');
});


require __DIR__.'/auth.php';