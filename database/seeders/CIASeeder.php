<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CIASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cia')->insert([
            [
                'kategori_aset_id' => 'data',
                'c' => 4,
                'i' => 5,
                'a' => 3,
                'aset_value' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori_aset_id' => 'software',
                'c' => 3,
                'i' => 4,
                'a' => 4,
                'aset_value' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori_aset_id' => 'hardware',
                'c' => 4,
                'i' => 3,
                'a' => 5,
                'aset_value' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}