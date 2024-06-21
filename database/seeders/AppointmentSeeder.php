<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment ;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // first doctor
        Appointment::create([
            'days' => 'Sunday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 1
        ]);
        Appointment::create([
            'days' => 'Monday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 1
        ]);
        Appointment::create([
            'days' => 'Wednesday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 2
        ]);
        // secound doctor
        Appointment::create([
            'days' => 'Saturday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 3
        ]);
        Appointment::create([
            'days' => 'Thursday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 4
        ]);
        Appointment::create([
            'days' => 'Saturday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 6
        ]);
        // 3 => doctor
        Appointment::create([
            'days' => 'Monday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 6
        ]);
        Appointment::create([
            'days' => 'Friday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 6
        ]);
        Appointment::create([
            'days' => 'Tuesday' ,
            'Start_at' => 2 ,
            'End_at' => 10 ,
            'doctor_id' => 7
        ]);
    }
}
