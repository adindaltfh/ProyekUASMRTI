<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('risk')->insert([
            [
                'nama_risiko' => 'Data Breach',
                'dampak' => 'Unauthorized access to sensitive customer data, potential financial and reputational damage',
                'kategori_aset' => 'data',
                'current_control' => 'Basic access controls, no data encryption',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_risiko' => 'Software Vulnerabilities',
                'dampak' => 'Potential data corruption, system downtime, and financial losses',
                'kategori_aset' => 'software',
                'current_control' => 'Outdated software versions, limited security testing',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_risiko' => 'Hardware Failure',
                'dampak' => 'Prolonged system downtime, potential data loss, and business disruption',
                'kategori_aset' => 'hardware',
                'current_control' => 'Limited redundancy, no backup power solution',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}