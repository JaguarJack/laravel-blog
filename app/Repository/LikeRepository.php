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
}
