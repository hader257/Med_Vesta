<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor ;
use Hash , DB ;
class DoctorSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('doctors')->delete() ;
        Doctor::create([
            'name' => ['ar' => 'محمود عبدالرحيم' , 'en' => 'Mahmoud Abdelrehim'],
            'bio' => ['ar' => 'دكتور محمود استشاري قلب في جامعة عين شمس خبرة عشرين عاما لدي خبرة عالية و سافر الي العيديد من الدول', 'en' => 'Dr Mahmoud supervisor heart in Ain Shamse University , and i have high experience and arrive to multiple countries '],
            'phone' => '01201955377',
            'email' => 'mahmoud@gmail.com' ,
            'image' => 'doctors/default.jpg' ,
            'password' => Hash::make('123456789') ,
            'nid' => '303012641401683' ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 0 ,
            'gov_id' => '1' ,
            'special_id' => '1' ,
        ]);

        Doctor::create([
            'name' => ['ar' => 'حسام علي' , 'en' => 'Hossam Ali'],
            'bio' => ['ar' => 'دكتور محمود استشاري قلب في جامعة عين شمس خبرة عشرين عاما لدي خبرة عالية و سافر الي العيديد من الدول', 'en' => 'Dr Mahmoud supervisor heart in Ain Shamse University , and i have high experience and arrive to multiple countries '],
            'phone' => '01201696438',
            'email' => 'hossam@gmail.com' ,
            'image' => 'doctors/default.jpg' ,
            'password' => Hash::make('123456789') ,
            'nid' => '303112641451489' ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 1 ,
            'gov_id' => '1' ,
            'special_id' => '2' ,
        ]);

        Doctor::create([
            'name' => ['ar' => 'فادي عماد' , 'en' => 'Fady Emad'],
            'bio' => ['ar' => 'دكتور محمود استشاري قلب في جامعة عين شمس خبرة عشرين عاما لدي خبرة عالية و سافر الي العيديد من الدول', 'en' => 'Dr Mahmoud supervisor heart in Ain Shamse University , and i have high experience and arrive to multiple countries '],
            'phone' => '01203469777',
            'email' => 'fady@gmail.com' ,
            'image' => 'doctors/default.jpg' ,
            'password' => Hash::make('123456789') ,
            'nid' => '303113941405683' ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 2 ,
            'gov_id' => '1' ,
            'special_id' => '2' ,
        ]);

        Doctor::create([
            'name' => ['ar' => 'إسلام سمير' , 'en' => 'Eslam Samir'],
            'bio' => ['ar' => 'دكتور محمود استشاري قلب في جامعة عين شمس خبرة عشرين عاما لدي خبرة عالية و سافر الي العيديد من الدول', 'en' => 'Dr Mahmoud supervisor heart in Ain Shamse University , and i have high experience and arrive to multiple countries '],
            'phone' => '01206469777',
            'email' => 'eslam@gmail.com' ,
            'image' => 'doctors/default.jpg' ,
            'password' => Hash::make('123456789') ,
            'nid' => '303113959405683' ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 1 ,
            'gov_id' => '3' ,
            'special_id' => '4' ,
        ]);

        Doctor::create([
            'name' => ['ar' => 'محمد امام' , 'en' => 'Mohamed Emam'],
            'bio' => ['ar' => 'دكتور محمود استشاري قلب في جامعة عين شمس خبرة عشرين عاما لدي خبرة عالية و سافر الي العيديد من الدول', 'en' => 'Dr Mahmoud supervisor heart in Ain Shamse University , and i have high experience and arrive to multiple countries '],
            'phone' => '01206469777',
            'email' => 'mohamed@gmail.com' ,
            'image' => 'doctors/default.jpg' ,
            'password' => Hash::make('123456789') ,
            'nid' => '303113941697683' ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 1 ,
            'gov_id' => '1' ,
            'special_id' => '2' ,
        ]);

        Doctor::create([
            'name' => ['ar' => 'خالد سلامة' , 'en' => 'Khaled Salama'],
            'bio' => ['ar' => 'دكتور محمود استشاري قلب في جامعة عين شمس خبرة عشرين عاما لدي خبرة عالية و سافر الي العيديد من الدول', 'en' => 'Dr Mahmoud supervisor heart in Ain Shamse University , and i have high experience and arrive to multiple countries '],
            'phone' => '01163469787',
            'email' => 'khaled@gmail.com' ,
            'image' => 'doctors/default.jpg' ,
            'password' => Hash::make('123456789') ,
            'nid' => '303113941405683' ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 1 ,
            'gov_id' => '1' ,
            'special_id' => '2' ,
        ]);

        Doctor::create([
            'name' => ['ar' => 'علاء رضا' , 'en' => 'Alaa Reda'],
            'bio' => ['ar' => 'دكتور محمود استشاري قلب في جامعة عين شمس خبرة عشرين عاما لدي خبرة عالية و سافر الي العيديد من الدول', 'en' => 'Dr Mahmoud supervisor heart in Ain Shamse University , and i have high experience and arrive to multiple countries '],
            'phone' => '01203469777',
            'email' => 'alaa@gmail.com' ,
            'image' => 'doctors/default.jpg' ,
            'password' => Hash::make('123456789') ,
            'nid' => '303113941569783' ,
            'img_verify' => 'doctor/verify.png' ,
            'status' => 1 ,
            'gov_id' => '1' ,
            'special_id' => '2' ,
        ]);

    }
}
