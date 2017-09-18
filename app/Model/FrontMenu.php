<?php

namespace App\Model;

use App\Model\BaseModel;

class FrontMenu extends BaseModel
{
    //
    
    protected $table = 'category';
    
    //填充字段
    protected $fillable = [
        'fid', 'cname', 'code',
    ];
    
    //是否自动更新时间字段
    public $timestamps = false;
}
