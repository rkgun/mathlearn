<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $settings=array(
            'site_name'=>'MathLearn',
            'logo'=>'',
            'icon'=>'images/indir.ico',
            'mail'=>'mathlearn@gmail.com',
            'author'=>'Redday',
            'meta_keys'=>'Mathlearn, matematik öğrenimi, üniversite matematik', 'meta_desc'=>'MathLearn Matematikte ustalaşmak için ihtiyaç duyduğun her şey.',
            'site_url'=>'127.0.0.1:8000'
            );
        foreach($settings as $key=>$value){
            DB::table('settings')->insert([
                'name'=>$key,
                'value'=>$value,
                'locked'=>true
            ]);
        }
    }
}
