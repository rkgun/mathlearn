<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses=['Analiz I','Lineer Cebir','Diferansiyel Denklemler'];
        $i=1;
        foreach($courses as $course){
            $c=DB::table('courses')->insert([
                'name'=>$course,
                'slug'=>Str::slug($course),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
            DB::table('metas')->insert([
                ['name'=>'title','value'=>'meta başlık','metable_id'=>$i,'metable_type'=>'course'],
                ['name'=>'keywords','value'=>'meta anahtar kelimeleri','metable_id'=>$i,'metable_type'=>'course'],
                ['name'=>'description','value'=>'meta açıklaması','metable_id'=>$i,'metable_type'=>'course']
            ]);
            $i++;
        }

    }
}
