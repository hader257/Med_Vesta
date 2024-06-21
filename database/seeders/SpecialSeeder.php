<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization ;


class SpecialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialization::create([
            'name' => [
                'ar' => 'القلب' ,
                'en' => 'Heart'
            ]
        ]);

        Specialization::create([
            'name' => [
                'ar' => 'الاسنان' ,
                'en' => 'Teeth'
            ]
        ]);

        Specialization::create([
            'name' => [
                'ar' => 'أمراض الجلدية' ,
                'en' => 'Dermatological Diseases'
            ]
        ]);

        Specialization::create([
            'name' => [
                'ar' => 'الجراحة' ,
                'en' => 'Surgery'
            ]
        ]);

        Specialization::create([
            'name' => [
                'ar' => 'الطب النفسي' ,
                'en' => 'Psychiatry'
            ]
        ]);


        Specialization::create([
            'name' => [
                'ar' => 'نسا و توليد' ,
                'en' => 'Women\'s Health and Obstetrics'
            ]
        ]);


        Specialization::create([
            'name' => [
                'ar' => 'امراض الباطنة' ,
                'en' => 'Internal Medicine'
            ]
        ]);

        Specialization::create([
            'name' => [
                'ar' => 'امراض الاجهزة التنفسي' ,
                'en' => 'Respiratory Diseases'
            ]
        ]);


        Specialization::create([
            'name' => [
                'ar' => 'أمراض السكر' ,
                'en' => 'Diabetes'
            ]
        ]);


        Specialization::create([
            'name' => [
                'ar' => 'أمراض الكلي' ,
                'en' => 'Kidney Diseases'
            ]
        ]);


        Specialization::create([
            'name' => [
                'ar' => 'أمراض العيون' ,
                'en' => 'Eyes Diseases'
            ]
        ]);
    }
}
