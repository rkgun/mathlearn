<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Visitors extends Model
{
    use HasFactory;
    protected $table = 'shetabit_visits';
    public static function totalVisitCount(){
        return static::get()->count();
    }
    public static function monthVisitCount(){
        $now=Carbon::now();
        return static::where('created_at','>=',$now->subDays(29))->get()->count();
    }
    public static function onlineVisitCount(){
        $now=Carbon::now();
        return static::where('created_at','==',$now)->get()->count();
    }
    public static function lastVisit(){
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
                )->get()->count()
        ];
        return $data;
    }
    public static function topicVisit(){
        $now=Carbon::now();
        $data=[
            static::where('created_at','>=',$now->subDays(30))->where('referer', 'like', '%topic%')->get()->count(),
            static::whereBetween('created_at',
            [$now->subDays(60),$now->subDays(30)]
            )->where('referer', 'like', '%topic%')->get()->count(),
            static::whereBetween('created_at',
            [$now->subDays(90),$now->subDays(60)]
            )->where('referer', 'like', '%topic%')->get()->count(),
            static::whereBetween('created_at',
            [$now->subDays(120),$now->subDays(90)]
            )->where('referer', 'like', '%topic%')->get()->count(),
            static::whereBetween('created_at',
            [$now->subDays(150),$now->subDays(120)]
            )->where('referer', 'like', '%topic%')->get()->count(),
            static::whereBetween('created_at',
            [$now->subDays(180),$now->subDays(150)]
            )->where('referer', 'like', '%topic%')->get()->count()
        ];
        return $data;
    }
    public static function courseVisit($slug){
        return static::where('referer','like',"%{$slug}%")->get()->count();
    }
    public static function topicVisitCount($topics){
            $total=0;
            foreach($topics as $topic){
                $total+= static::where('referer','like',"%{$topic->slug}%")->get()->count();
            }
            return $total;
    }
}
