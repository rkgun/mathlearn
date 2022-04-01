<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Page extends Model
{
    use HasFactory;
    public $fillable = ['name', 'parallax_path', 'parallax_content','content','locked'];
    public function meta(){
        return $this->hasMany(Meta::class, 'metable_id')->where('metable_type','page');
    }
}
