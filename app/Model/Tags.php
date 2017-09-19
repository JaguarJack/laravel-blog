<?php

namespace App\Model;

use App\Model\TagsRelate;
use App\Model\Article;

class Tags extends BaseModel
{
    //
    
    protected $table = 'tags';
    
    protected $fillable = ['name'];
    
    
    public function hasManyArticles()
    {
        return $this->hasManyThrough(TagsRelate::class, Article::class, 'id', 'tag_id')
                    ->select('articles.id', 'articles.title','articles.author','articles.created_at','articles.category')
                    ->orderBy('articles.id', 'DESC');
    }
}
