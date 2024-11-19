<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assets')->insert([
            [
                'kategori' => 'data',
                'nama_aset' => 'Customer Data',
                'risiko_terkait' => 'Unauthorized access, data breach',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori' => 'software',
                'nama_aset' => 'Accounting Software',
                'risiko_terkait' => 'Software vulnerabilities, data corruption',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori' => 'hardware',
                'nama_aset' => 'Server Hardware',
                'risiko_terkait' => 'Hardware failure, power outages',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}