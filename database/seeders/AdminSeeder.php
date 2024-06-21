<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin ;
use Hash ;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Mahmoud Osha',
            'email' => 'mahmoud@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        Admin::create([
            'name' => 'Eslam Omar',
            'email' => 'eslam@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
