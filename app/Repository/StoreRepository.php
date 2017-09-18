<?php

namespace App\Repository;

use App\Model\Store;

class StoreRepository
{
    protected static $store;
    
    public function __construct(Store $store)
    {
        self::$store= $store;
    }
    
    /**
     *
     * @description:是否点赞
     * @author wuyanwen(2017年9月16日)
     * @param
     */
    public function isStored($user_id, $aid)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['aid', '=', $aid],
        ];
        
        return self::$store::where($where)->first() ? true : false;
    }
    
    /**
     *
     * @description:点赞
     * @author wuyanwen(2017年9月16日)
     * @param@param unknown $user_id
     * @param@param unknown $attend_user_id
     */
    public function store($user_id, $aid)
    {
        return self::$store::create([
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
        
        return self::$store::where($where)->delete();
    }
}
