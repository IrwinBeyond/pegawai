<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserFromEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            if ($employee->user_id) {
                continue;
            }

            $user = User::create([
                'name' => $employee->nama_lengkap,
                'email' => $employee->email,
                'password' => Hash::make('password'),
                'role' => 'employee',
            ]);

            $employee->user_id = $user->id;
            $employee->save();
        }
    }
}
