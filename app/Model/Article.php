<?php

namespace App\Model;

use App\Model\ArticleRelate;
use App\Model\Comment;
use App\Model\Users;

class Article extends BaseModel
{
    //
    protected $table = 'articles';
    
    protected $fillable = [
      'cid', 'fid','user_id','author','category','intro','title', 'tags' , 'content','status',     
    ];
    //草稿状态
    const DRAFT_STATUS = 1;
    //审核状态
    const AUDIT_STATUS = 2;
    //通过状态
    const PASS_STATUS  = 3;
    //限制每页数量
    const LIMIT        = 10;
    
    /**
     * @description:关联article_relate
     * @author wuyanwen(2017年9月14日)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hasOneRelateInfo()
    {
        return $this->hasOne(ArticleRelate::class, 'aid')
                    ->select('article_relate.*');
    }
    
    /**
     * 
     * @description:关联文章评论
     * @author wuyanwen(2017年9月14日)
     * @param
     */
    public function hasManyComments()
    {
        return $this->hasMany(Comment::class, 'aid');
    }
    
    /**
     * @description:
     * @author wuyanwen(2017年9月19日)
     */
    public function hasManyRelateInfo()
    {
        return $this->hasManyThrough(ArticleRelate::class,'aid')
                    ->select('article_relate.like_number', 'article_relate.store_number', 'article_relate.comment_number', 
                             'article_relate.pv_number');
    }
}
