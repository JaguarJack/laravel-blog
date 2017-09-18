<?php

namespace App\Repository;

use App\Model\ArticleRelate;

class ArticleRelateRepository
{
    //
    protected static $article_relate;
    public function __construct(ArticleRelate $article_relate)
	{
	    self::$article_relate = $article_relate;
    }
    
    /**
     * 
     * @description:增加点赞数
     * @author wuyanwen(2017年9月17日)
     * @param@param unknown $aid
     * @param@return unknown
     */
    public function incrementLikeNum($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)->increment('like_number');
    }
    
    /**
     * 
     * @description:减少点赞数
     * @author wuyanwen(2017年9月17日)
     * @param@param unknown $aid
     * @param@return unknown
     */
    public function decrementLikeNum($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)->decrement('like_number');
    }
    
    /**
     *
     * @description:增加收藏数
     * @author wuyanwen(2017年9月17日)
     * @param@param unknown $aid
     * @param@return unknown
     */
    public function incrementStoreNum($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)->increment('store_number');
    }
    
    /**
     *
     * @description:减少收藏数
     * @author wuyanwen(2017年9月17日)
     * @param@param unknown $aid
     * @param@return unknown
     */
    public function decrementStoreNum($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)->decrement('store_number');
    }
    
    /**
     *
     * @description:增加评论数
     * @author wuyanwen(2017年9月17日)
     * @param@param unknown $aid
     * @param@return unknown
     */
    public function incrementCommentNum($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)->increment('comment_number');
    }
    
    /**
     *
     * @description:减少评论数
     * @author wuyanwen(2017年9月17日)
     * @param@param unknown $aid
     * @param@return unknown
     */
    public function decrementCommentNum($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)->decrement('comment_number');
    }
    
    /**
     *
     * @description:增加pv
     * @author wuyanwen(2017年9月17日)
     * @param@param unknown $aid
     * @param@return unknown
     */
    public function incrementPvNum($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)->increment('pv_number');
    }

}
