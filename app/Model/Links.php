<?php

namespace App\Model;

class Links extends BaseModel
{
    //
    protected $table = 'links';
    
    protected $fillable = [
        'title', 'url', 'show', 'weight','type',
    ];
}
