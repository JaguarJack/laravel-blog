<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $table = 'store';
    
    protected $fillable = ['aid', 'user_id'];
    
    public $timestamps = false;
}
