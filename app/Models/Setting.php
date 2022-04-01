<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static function list(){
        $setting=[];
        foreach(static::all() as $key=>$value){
            $setting[$value['name']]=$value['value'];
        }
        return $setting;
    }
}
