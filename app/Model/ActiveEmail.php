<?php

namespace App\Model;

class ActiveEmail extends BaseModel
{
    //
    protected $table = 'active_email';
    
    protected $fillable = [
        'email', 'code','user_id',
    ];
}
