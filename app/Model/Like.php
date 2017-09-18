<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $table = 'like';
    
    protected $fillable = ['aid', 'user_id'];
    
    public $timestamps = false;
}
