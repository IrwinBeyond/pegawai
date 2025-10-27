<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('salaries', SalaryController::class);
Route::resource('attendances', AttendanceController::class);
