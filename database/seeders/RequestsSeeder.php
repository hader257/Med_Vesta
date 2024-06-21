<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requests ;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Requests::create([
            'date' => '2024-06-23',
            'day' => 'Sunday',
            'oclock' => 3 ,
            'doctor_id' => 1 ,
            'patient_id' => 1
        ]);
        Requests::create([
            'date' => '2024-04-06',
            'day' => 'Monday',
            'oclock' => 5 ,
            'doctor_id' => 1 ,
            'patient_id' => 2
        ]);
        Requests::create([
            'date' => '2024-03-09',
            'day' => 'Sunday',
            'oclock' => 4 ,
            'doctor_id' => 2 ,
            'patient_id' => 3
        ]);
    }
}
