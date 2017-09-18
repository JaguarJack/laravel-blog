<?php

namespace App\Model;

class ArticleRelate extends BaseModel
{
    //
    protected $table = 'article_relate';
    
    protected $fillable = [
        'aid', 'user_id', 'like_num', 'enshirne_num', 'comment_num' ,
    ];
    
}
