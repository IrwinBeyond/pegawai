<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $departments = \App\Models\Department::pluck('id')->toArray();
        $positions = \App\Models\Position::pluck('id', 'nama_jabatan')->toArray();

        $count = 100;
        $usedEmails = [];

        for ($i = 0; $i < $count; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $fullName = $firstName . ' ' . $lastName;

            $localPart = strtolower(preg_replace('/[^a-zA-Z]/', '', $firstName));
            if ($localPart === '') {
                $localPart = 'user' . $faker->numberBetween(1,9999);
            }
            $email = $localPart . '@example.com';
            $suffix = 1;
            while (in_array($email, $usedEmails) || Employee::where('email', $email)->exists()) {
                $email = $localPart . $suffix . '@example.com';
                $suffix++;
            }
            $usedEmails[] = $email;

            $phone = '08' . $faker->numerify(str_repeat('#', $faker->numberBetween(8, 10)));

            $birth = $faker->dateTimeBetween('-45 years', '-17 years')->format('Y-m-d');

            $alamatTemplates = [
                'Jl. Cempaka No. ' . $faker->numberBetween(1,200),
                'Jl. Melati No. ' . $faker->numberBetween(1,200),
                'Jl. Anggrek No. ' . $faker->numberBetween(1,200),
                'Perumahan Suka Maju Blok ' . strtoupper($faker->randomLetter),
                'Kompleks Permata Indah No. ' . $faker->numberBetween(1,200),
            ];
            $alamat = $faker->randomElement($alamatTemplates);

            $tanggalMasukObj = $faker->dateTimeBetween('2000-01-01', 'now');
            $tanggalMasuk = $tanggalMasukObj->format('Y-m-d');

            $yearsOfService = (int)date('Y') - (int)$tanggalMasukObj->format('Y');

            $departemenId = $faker->randomElement($departments);

            $positionName = $this->pickPositionBySeniority($yearsOfService, $faker);
            $positionId = $positions[$positionName] ?? $faker->randomElement(array_values($positions));

            $nonaktifChance = 5;
            if ($yearsOfService >= 15) $nonaktifChance = 30;
            elseif ($yearsOfService >= 7) $nonaktifChance = 15;
            elseif ($yearsOfService >= 3) $nonaktifChance = 8;
            else $nonaktifChance = 3;

            $status = ($faker->numberBetween(1,100) <= $nonaktifChance) ? 'nonaktif' : 'aktif';

            Employee::create([
                'nama_lengkap' => $fullName,
                'email' => $email,
                'nomor_telepon' => $phone,
                'tanggal_lahir' => $birth,
                'alamat' => $alamat,
                'tanggal_masuk' => $tanggalMasuk,
                'departemen_id' => $departemenId,
                'jabatan_id' => $positionId,
                'status' => $status,
                'user_id' => null,
            ]);
        }
    }

    private function pickPositionBySeniority(int $years, $faker)
    {
        $seniorPool = array_merge(
            array_fill(0, 6, 'Director'),
            array_fill(0, 12, 'Manager'),
            array_fill(0, 15, 'Supervisor'),
            array_fill(0, 20, 'Senior Staff')
        );

        $middlePool = array_fill(0, 30, 'Staff');

        $juniorPool = array_fill(0, 40, 'Junior Staff') + array_fill(0, 20, 'Intern');

        if ($years >= 15) {
            $pool = array_merge($seniorPool, $middlePool, array_fill(0, 5, 'Senior Staff'));
        } elseif ($years >= 7) {
            $pool = array_merge($seniorPool, $middlePool, array_fill(0, 10, 'Supervisor'));
        } elseif ($years >= 3) {
            $pool = array_merge($middlePool, $juniorPool, array_fill(0, 5, 'Supervisor'));
        } else {
            $pool = array_merge($juniorPool, $middlePool);
        }

        return $pool[$faker->numberBetween(0, count($pool) - 1)];
    }
}
