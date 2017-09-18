<?php

namespace App\Model;

class Seo extends BaseModel
{
    protected $table = 'seo';
    
    //填充字段
    protected $fillable = [
        'cid', 'title', 'keywords', 'description',
    ];
}
