<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=array(
            'Anasayfa'=>array(
                'images/photo-1454496522488-7a8e488e8606.jpeg',
                '<h2>Matematikte</h2>
                <h1>Ustalaşmak için ihtiyacınız olan her şey</h1>',
                'index','Anasayfa'),
            'Gizlilik Politikası'=>array(
                    'images/photo-1454496522488-7a8e488e8606.jpeg','<h2>Matematikte</h2>
                    <h1>Ustalaşmak için ihtiyacınız olan her şey</h1>',
                    'privacy&policy','Gizlilik Politikası'),
            'Hakkımızda'=>array(
                        'images/photo-1454496522488-7a8e488e8606.jpeg','<h2>Matematikte</h2>
                        <h1>Ustalaşmak için ihtiyacınız olan her şey</h1>',
                        'about-us','Hakkımızda'),
            'Aranılan Sayfa Bulunamadı'=>array(
                'images/photo-1454496522488-7a8e488e8606.jpeg','<h2>Matematikte</h2>
                <h1>Ustalaşmak için ihtiyacınız olan her şey</h1>',
                'error','<div class="px-40 py-20 bg-white rounded-md shadow-xl">     <div class="flex flex-col items-center">       <h1 class="font-bold text-blue-600 text-9xl">404</h1>        <h6 class="mb-2 text-2xl font-bold text-center text-gray-800 md:text-3xl">         <span class="text-red-500">Oops!</span> Page not found       </h6>        <p class="mb-8 text-center text-gray-500 md:text-lg">         The page you’re looking for doesn’t exist.       </p>        <a         href="#"         class="px-6 py-2 text-sm font-semibold text-blue-800 bg-blue-100"         >Go home</a       >     </div>   </div>'),
        );
        $i=1;
        foreach($pages as $page=>$values){
                $p=DB::table('pages')->insert([
                    'name'=>$page,
                    'slug'=>Str::slug($values[2]),
                    'parallax_path'=>$values[0],
                    'parallax_content'=>$values[1],
                    'locked'=>true,
                    'content'=>$values[3],
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
                DB::table('metas')->insert([
                    ['name'=>'title','value'=>'meta başlık','metable_id'=>$i,'metable_type'=>'page'],
                    ['name'=>'keywords','value'=>'meta anahtar kelimeleri','metable_id'=>$i,'metable_type'=>'page'],
                    ['name'=>'description','value'=>'meta açıklaması','metable_id'=>$i,'metable_type'=>'page']
                ]);
                $i++;
        }
    }
}
