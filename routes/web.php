<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.employees.index');
    }
    return redirect()->route('employee.home');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('departments', DepartmentController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('salaries', SalaryController::class);
        Route::resource('attendances', AttendanceController::class);
        Route::get('employees/{employee}/create-user', [EmployeeController::class, 'createUser'])
                ->name('employees.create-user');
        Route::post('employees/{employee}/create-user', [EmployeeController::class, 'storeUser'])
                ->name('employees.store-user');
        Route::get('employees/{employee}/edit-user', [EmployeeController::class, 'editUser'])
            ->name('employees.edit-user');
        Route::put('employees/{employee}/update-user', [EmployeeController::class, 'updateUser'])
            ->name('employees.update-user');
    });

Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {
        Route::get('/', [EmployeeDashboardController::class, 'index'])->name('home');
        Route::get('attendances', [EmployeeAttendanceController::class, 'index'])
            ->name('attendances.index');
        Route::post('attendances/check-in', [EmployeeAttendanceController::class, 'checkIn'])
            ->name('attendances.checkin');
        Route::post('attendances/check-out', [EmployeeAttendanceController::class, 'checkOut'])
            ->name('attendances.checkout');
    });


require __DIR__.'/auth.php';