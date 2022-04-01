<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $fillable = ['name','active','deleted'];
    public function meta(){
        return $this->hasMany(Meta::class, 'metable_id')->where('metable_type','course');
    }
    public function suggest(){
        return $this->hasMany(Suggest::class, 'suggest_id')->where('suggest_type','course');
    }
    public function topics(){
        return $this->hasMany(Topic::class, 'course_id', 'id')->where('deleted',false);
    }
    public function nonDeleted(){
        return static::where('deleted',false)->get();
    }
    public static function active(){
        return static::where('active',true)->where('deleted',false)->get();
    }
}
