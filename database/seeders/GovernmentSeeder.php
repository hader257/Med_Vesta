<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Government ;
class GovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Government::create([
            'name' => [
                'ar' => 'القاهرة' ,
                'en' => 'Cairo'
            ]
        ]);

        Government::create([
            'name' => [
                'ar' => 'الجيزة' ,
                'en' => 'Giza'
            ]
        ]);

        Government::create([
            'name' => [
                'ar' => 'الاسكندرية' ,
                'en' => 'Alexandria'
            ]
        ]);

        Government::create([
            'name' => [
                'ar' => 'شبرا' ,
                'en' => 'Shubra'
            ]
        ]);

        Government::create([
            'name' => [
                'ar' => 'اسوان' ,
                'en' => 'Aswan'
            ]
        ]);


        Government::create([
            'name' => [
                'ar' => 'بورسعيد' ,
                'en' => 'Port Said'
            ]
        ]);


        Government::create([
            'name' => [
                'ar' => 'الاسماعلية' ,
                'en' => 'Esmalia'
            ]
        ]);
    }
}
