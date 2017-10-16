<?php

namespace App\Model;

class Questions extends BaseModel
{
    //
    protected $table = 'questions';
    
    protected $fillable = ['user_id', 'title', 'subject', 'pv', 'comment_number', 'status'];
}
