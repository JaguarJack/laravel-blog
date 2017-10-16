<?php

namespace App\Model;

class Answer extends Base
{
    //
    
    protected $table = 'answer';
    
    protected $fillable = ['user_id', 'qid', 'content', 'status'];
}
