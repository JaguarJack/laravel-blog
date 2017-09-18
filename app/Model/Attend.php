<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    //
    protected $table = 'attend';
    
    protected $fillable = ['user_id', 'attend_user_id'];
    
    public $timestamps = false;
}
