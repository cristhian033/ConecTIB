<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'password'=> Hash::make('admin'),
            'name' => 'admin',
            'phone' => '123456',
            'document' => '123456',
            'birth_date' => '1960-01-01',
            'city_id' => 1,
            'rol_id' => 1
        ]);
    }
}
