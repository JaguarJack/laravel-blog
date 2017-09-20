<?php

namespace App\Model;

use App\Model\Article;

class Comment extends BaseModel
{
    //
    protected $table = 'comments';
    
    public $fillable = [
        'user_id','user_name', 'content', 'aid','avatar',
    ];    
}
