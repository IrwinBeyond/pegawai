<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    public function run(): void
    {
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = Carbon::create(2024, $m, 1)->format('Y-m');
        }

        $employees = Employee::with('position')->take(100)->get();

        $rules = [
            'director' => ['allowance' => [8000000, 15000000], 'deduction' => [500000, 1500000]],
            'manager'  => ['allowance' => [5000000, 9000000],  'deduction' => [300000, 800000]],
            'senior'   => ['allowance' => [2500000, 5000000],  'deduction' => [150000, 500000]],
            'staff'    => ['allowance' => [1000000, 3000000],  'deduction' => [100000, 300000]],
            'junior'   => ['allowance' => [500000, 1500000],   'deduction' => [50000, 200000]],
            'intern'   => ['allowance' => [0, 300000],         'deduction' => [0, 50000]],
            'default'  => ['allowance' => [500000, 2000000],   'deduction' => [50000, 500000]],
        ];

        $getRule = function (?string $positionName) use ($rules) {
            if (!$positionName) return $rules['default'];
            $p = Str::lower($positionName);
            foreach (['director','manager','senior','junior','intern','staff'] as $k) {
                if (Str::contains($p, $k)) return $rules[$k];
            }
            return $rules['default'];
        };

        $inserts = [];

        foreach ($employees as $employee) {
            $positionName = $employee->position->nama_jabatan ?? null;
            $rule = $getRule($positionName);

            $gajiPokok = (int) ($employee->position->gaji_pokok ?? 0);

            foreach ($months as $bulan) {
                $tunjangan = mt_rand($rule['allowance'][0], $rule['allowance'][1]);
                $potongan  = mt_rand($rule['deduction'][0], $rule['deduction'][1]);

                $variator = 1 + (mt_rand(-5, 5) / 100);
                $tunjangan = (int) round($tunjangan * $variator);
                $potongan  = (int) round($potongan * $variator);

                $potongan = min($potongan, max(0, $gajiPokok + $tunjangan));

                $totalGaji = $gajiPokok + $tunjangan - $potongan;

                $inserts[] = [
                    'karyawan_id' => $employee->id,
                    'bulan'       => $bulan,
                    'gaji_pokok'  => $gajiPokok,
                    'tunjangan'   => $tunjangan,
                    'potongan'    => $potongan,
                    'total_gaji'  => $totalGaji,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];

                if (count($inserts) >= 500) {
                    DB::table('salaries')->insert($inserts);
                    $inserts = [];
                }
            }
        }

        if (!empty($inserts)) {
            DB::table('salaries')->insert($inserts);
        }
    }
}
