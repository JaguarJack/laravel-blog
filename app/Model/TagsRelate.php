<?php

namespace App\Model;

class TagsRelate extends BaseModel
{
    //
    
    protected $table = 'tags_relate';
    
    protected $fillable = ['aid','user_id','tag_id'];
}
