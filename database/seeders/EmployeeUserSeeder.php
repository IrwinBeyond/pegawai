<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = Employee::find(1);

        if (!$employee) {
            $this->command->error('Employee dengan ID 1 tidak ditemukan.');
            return;
        }

        $user = User::updateOrCreate(
            ['email' => $employee->email],
            [
                'name' => $employee->nama_lengkap,
                'password' => Hash::make('password'),
                'role' => 'employee',
            ]
        );

        $employee->user_id = $user->id;
        $employee->save();

        $this->command->info('User employee untuk '.$employee->nama_lengkap.' berhasil dibuat. ID user: '.$user->id);
    }
}
