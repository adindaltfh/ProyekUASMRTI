<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiskValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('risk_value')->insert([
            [
                'risk_id' => 1,
                'nilai_risiko' => 12,
                'level' => 'medium'
            ],
            [
                'risk_id' => 2,
                'nilai_risiko' => 24,
                'level' => 'high'
            ],
            [
                'risk_id' => 3,
                'nilai_risiko' => 20,
                'level' => 'high'
            ]
        ]);
    }
}