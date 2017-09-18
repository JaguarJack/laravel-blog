<?php

namespace App\Model;

use App\Model\Article;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    
    
    public function hasManyA()
    {
        return $this->hasManyThrough(Article::class, 'App\Model\ArticleRelate', 'aid', 'uid')->select('article_option.*', 'article.*')->limit(5);
    }
}
