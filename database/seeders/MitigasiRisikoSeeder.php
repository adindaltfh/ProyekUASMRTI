<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MitigasiRisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mitigasi_risiko')->insert([
            [
                'risk_id' => 1,
                'asset_id' => 1,
                'tanggal' => '2023-05-15',
                'klausul' => 'Access control, data encryption',
                'mitigasi_risiko' => 'Implement strong access controls and data encryption measures',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'risk_id' => 2,
                'asset_id' => 2,
                'tanggal' => '2023-06-01',
                'klausul' => 'Regular software updates, security testing',
                'mitigasi_risiko' => 'Maintain regular software updates and conduct security testing',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}