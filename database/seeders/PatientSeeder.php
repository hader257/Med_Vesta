<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient ;
use Hash ;
class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'name' => 'Kareem Hady' ,
            'email' => 'kareem@gmail.com' ,
            'password' => Hash::make('123456789') ,
            'phone' => '01201936647' ,
            'image' => 'patient/default.jpg' ,
            'address' => '35 شارع شبرا الخلفاوي',
            'gov_id' => 1
        ]);

        Patient::create([
            'name' => 'Adel Ramdan' ,
            'email' => 'adel@gmail.com' ,
            'password' => Hash::make('123456789') ,
            'phone' => '01123693814' ,
            'image' => 'patient/default.jpg' ,
            'address' => '89 شارع شبرا روض الفرج',
            'gov_id' => 1
        ]);

        Patient::create([
            'name' => 'Seif Salama' ,
            'email' => 'seif@gmail.com' ,
            'password' => Hash::make('123456789') ,
            'phone' => '01061934930' ,
            'image' => 'patient/default.jpg' ,
            'address' => '35 شارع شبرا مسرة',
            'gov_id' => 1
        ]);

    }
}
