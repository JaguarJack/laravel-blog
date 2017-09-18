<?php

namespace App\Model;

class Notice extends BaseModel
{
    //
    const COMMENT_NOTICE = 1;
    const ARITCLE_NOTICE = 2;
    const NOTREAD        = 1;
    const READED         = 2;
    
    protected $table = 'notice';
    
    protected $fillable = [
      'user_id', 'from_user_name', 'aid', 'type', 'is_read',  
    ];
}
