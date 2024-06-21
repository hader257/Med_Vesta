<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clinic ;
use DB ;
class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clinics')->delete() ;
        Clinic::create([
            'name' => [
                'ar' => 'عيادة الاسلام' ,
                'en' => 'El Eslam Clinic'
            ],
            'price' => 300 ,
            'address' => 'شارع العرب شبرا مصر اتجاة الخلفاوي عمارة 12',
            'doc_id' => 1
        ]);

        Clinic::create([
            'name' => [
                'ar' => 'عيادة الامل' ,
                'en' => 'El Amal Clinic'
            ],
            'address' => '',
            'price' => 250 ,
            'doc_id' => 2
        ]);

        Clinic::create([
            'name' => [
                'ar' => 'عيادة وادي الطب' ,
                'en' => 'WadyMed Clinic'
            ],
            'address' => 'شارع الخامس علي حسن منطقة الكوربة',
            'price' => 650 ,
            'doc_id' => 3
        ]);

        Clinic::create([
            'name' => [
                'ar' => 'عيادة الجلالة' ,
                'en' => 'ElGalah Clinic'
            ],
            'address' => 'شارع الخامس علي حسن منطقة الكوربة',

            'price' => 350 ,
            'doc_id' => 4
        ]);

        Clinic::create([
            'name' => [
                'ar' => 'عيادة الاسلام' ,
                'en' => 'Alslam Clinic'
            ],
            'address' => 'شارع الخامس علي حسن منطقة الكوربة',
            'price' => 800 ,
            'doc_id' => 5
        ]);

        Clinic::create([
            'name' => [
                'ar' => 'عيادة المعز' ,
                'en' => 'Moaza Clinic'
            ],
            'address' => 'شارع عمربن الخطاب مصر الجديد',
            'price' => 400 ,
            'doc_id' => 6
        ]);

        Clinic::create([
            'name' => [
                'ar' => 'عيادة خان خليلي' ,
                'en' => 'Khan Khalila Clinic'
            ],
            'address' => 'شارع السلام متفرع من شارع الامام ',
            'price' => 400 ,
            'doc_id' => 7
        ]);
    }
}
