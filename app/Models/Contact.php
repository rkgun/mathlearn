<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $fillable = ['name', 'email', 'message','contact_ip'];
    public static function nonDisplayed(){
        return static::where('displayed',false)->get();
    }
    public static function list(){
        return static::where('answered',false)->get(['id','name','email','message','created_at']);
    }
    public function read($id){
        $contact=static::where('id',$id)->first();
        $contact->displayed=true;
        $contact->save();
        return $contact;
    }
    
}
