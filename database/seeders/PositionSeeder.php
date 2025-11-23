<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            'Director',
            'Manager',
            'Supervisor',
            'Senior Staff',
            'Staff',
            'Junior Staff',
            'Intern',
        ];

        foreach ($positions as $name) {
            Position::create([
                'nama_jabatan' => $name,
                'gaji_pokok' => match($name) {
                    'Director' => 30000000,
                    'Manager' => 15000000,
                    'Supervisor' => 9000000,
                    'Senior Staff' => 7000000,
                    'Staff' => 4500000,
                    'Junior Staff' => 3000000,
                    'Intern' => 1000000,
                    default => 4000000,
                }
            ]);
        }
    }
}
