<?php

namespace App\Model;

use App\Model\Article;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\ArticleRelate;
use App\Model\Notice;
use App\Model\Comment;

class Users extends Authenticatable
{
    //
    
    protected $table = 'users';
    
    
    protected $fillable = [
        'open_id', 'user_name', 'password', 'email', 'avatar', 'signature', 'city', 'type',
        'api_token','sex', 'activation', 'status', 'online', 'github_name', 'github_homepage', 'website', 'introduction',
    ];
    
    /**
     * 
     * @description:查询文章
     * @author wuyanwen(2017年9月14日)
     * @param@return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasManyArticles()
    {
        return $this->hasMany(Article::class, 'user_id')->limit(5);
    }
    
    /**
     * @description:关联文章
     * @author wuyanwen(2017年9月18日)
     * @return unknown
     */
    public function hasManyUserArticles()
    {
        return $this->hasManyThrough(ArticleRelate::class, Article::class, 'user_id', 'aid')
                    ->select('article_relate.*', 'articles.title', 'articles.id', 'articles.created_at')
                    ->orderBy('articles.created_at', 'DESC')
                    ->limit(5);
    }
}
