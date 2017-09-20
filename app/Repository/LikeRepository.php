<?php

namespace App\Repository;

use App\Model\Like;

class LikeRepository
{
    protected static $like;
    
    public function __construct(Like $like)
    {
        self::$like = $like;
    }
    
    /**
     *
     * @description:是否点赞
     * @author wuyanwen(2017年9月16日)
     * @param
     */
    public function isLiked($user_id, $aid)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['aid', '=', $aid],
        ];
        
        return self::$like::where($where)->first() ? true : false;
    }
    
    /**
     *
     * @description:点赞
     * @author wuyanwen(2017年9月16日)
     * @param@param unknown $user_id
     * @param@param unknown $attend_user_id
     */
    public function like($user_id, $aid)
    {
        return self::$like::create([
            'user_id' => $user_id,
            'aid'     => $aid
        ]);
    }
    
    /**
     *
     * @description:取消点赞
     * @author wuyanwen(2017年9月16日)
     * @param@param unknown $user_id
     * @param@param unknown $aid
     */
    public function cancel($user_id, $aid)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['aid', '=', $aid],
        ];
        
        return self::$like::where($where)->delete();
    }
    
    /**
     * @description:获取用户喜欢的文章
     * @author wuyanwen(2017年9月20日)
     */
    public function getLikeArticles($user_id, $limit = 10, $offset = 0)
    {
        return self::$like::where('like.user_id', '=', $user_id)
                            ->leftjoin('articles', 'like.aid', '=', 'articles.id')
                            ->select('articles.id as aid','articles.title', 'articles.user_id', 'articles.author', 'articles.category', 'articles.cid')
                            ->orderBy('like.created_at', 'DESC')
                            ->offset($offset * $limit)
                            ->limit($limit)
                            ->get();
    }
    
    /**
     * @description:获取用户喜欢文章的总数
     * @author wuyanwen(2017年9月20日)
     * @param unknown $id
     */
    public function getTotalLike($user_id)
    {
        return self::$like::where('user_id', '=', $user_id)->count();
    }
}
