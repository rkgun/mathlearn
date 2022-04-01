<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Topic extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $fillable = ['title','parent_id','content','course_id','active','deleted'];
    public function parent() {
        return $this->belongsTo(Topic::class, 'parent_id');
    }
    public function childs(){
        return $this->hasMany(Topic::class, 'parent_id');
    }
    public static function nonDeleted(){
        return static::where('deleted',false)->get();
    }
    public function meta(){
        return $this->hasMany(Meta::class, 'metable_id')->where('metable_type','topic');
    }
    public function questions(){
        return $this->hasMany(Question::class, 'topic_id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function suggest(){
        return $this->hasMany(Suggest::class, 'suggest_id')->where('suggest_type','topic');
    }
    public static function lastTopics(){
        $now=Carbon::now();
        $data=[
            static::where('created_at','>=',$now->subDays(30))->get()->count(),
            static::whereBetween('created_at',
                [$now->subDays(60),$now->subDays(30)]
                )->get()->count(),
            static::whereBetween('created_at',
                [$now->subDays(90),$now->subDays(60)]
                )->get()->count(),
            static::whereBetween('created_at',
                [$now->subDays(120),$now->subDays(90)]
                )->get()->count(),
            static::whereBetween('created_at',
                [$now->subDays(150),$now->subDays(120)]
                )->get()->count(),
            static::whereBetween('created_at',
                [$now->subDays(180),$now->subDays(150)]
                )->get()->count()
        ];
        return $data;
    }

}
