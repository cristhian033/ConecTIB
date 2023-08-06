<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            CountrySeeder::class,
            DepartmentSeeder::class,
            CityPart1Seeder::class,
            CityPart2Seeder::class,
            CityPart3Seeder::class,
            RolSeeder::class,
            UserSeeder::class
        ]);
    }
}
