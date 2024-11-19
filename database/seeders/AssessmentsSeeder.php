<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessments')->insert([
            [
                'tanggal_evaluasi' => '2023-05-01',
                'user_id' => 1,
                'risk_id' => 1,
                'severity' => 3,
                'occurrence' => 2,
                'detection' => 1,
                'rpn' => 6,
                'level' => 'medium',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal_evaluasi' => '2023-06-15',
                'user_id' => 2,
                'risk_id' => 2,
                'severity' => 4,
                'occurrence' => 3,
                'detection' => 2,
                'rpn' => 24,
                'level' => 'high',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}