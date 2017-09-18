<?php

namespace App\Model;

class Comment extends BaseModel
{
    //
    protected $table = 'comments';
    
    public $fillable = [
        'user_id','user_name', 'content', 'aid','avatar',
    ];
}
