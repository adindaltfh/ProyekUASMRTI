<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Memanggil semua seeder yang telah dibuat
        $this->call([
            UsersSeeder::class,
            RiskSeeder::class, 
            RiskValueSeeder::class,      
            AssetsSeeder::class,   
            CIASeeder::class,        
            AssessmentsSeeder::class, 
            MitigasiRisikoSeeder::class, 
        ]);
    }
}
