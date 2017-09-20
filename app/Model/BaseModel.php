<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    const NORMAL_STATUS = 1;
    const DELETE_STATUS = 2;
    
    const LIMIT         = 10;
}