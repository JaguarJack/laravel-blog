<?php

namespace App\Model;

use App\Model\Article;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\ArticleRelate;

class Users extends Authenticatable
{
    //
    
    protected $table = 'users';
    
    
    protected $fillable = [
        'open_id', 'user_name', 'password', 'email', 'avatar', 'signature', 'come_from', 'type',
        'sex', 'activation', 'status', 'online',
    ];
    
    /**
     * 
     * @description:查询文章
     * @author wuyanwen(2017年9月14日)
     * @param@return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasManyArticles()
    {
        return $this->hasMany(Article::class, 'uid')->limit(5);
    }
    
    /**
     * @description:关联文章
     * @author wuyanwen(2017年9月18日)
     * @return unknown
     */
    public function hasManyUserArticles()
    {
        return $this->hasManyThrough(Article::class, ArticleRelate::class, 'aid', 'user_id')
                    ->select('article_relate.*', 'articles.*')
                    ->orderBy('articles.id', 'DESC')
                    ->limit(5);
    }
}
