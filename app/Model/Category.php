<?php

namespace App\Model;

class Category extends BaseModel
{
    //
    
    protected $table = 'category';
    
    //填充字段
    protected $fillable = [
        'fid', 'name', 'code',
    ];

    //是否自动更新时间字段
    public $timestamps = false;
}
