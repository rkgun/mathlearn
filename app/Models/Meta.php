<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;
    public $fillable = ['name', 'value', 'metable_id','metable_type'];
    protected $table = 'metas';
}
