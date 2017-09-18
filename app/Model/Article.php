<?php

namespace App\Model;

use App\Model\ArticleRelate;
use App\Model\Comment;

class Article extends BaseModel
{
    //
    protected $table = 'articles';
    
    protected $fillable = [
      'cid', 'fid','user_id','author','category','intro','title', 'thumb_img' , 'content','status',     
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
        return $this->hasOne(ArticleRelate::class, 'aid');
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
}
