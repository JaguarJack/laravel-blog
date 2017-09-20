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
     * @description:是否收藏
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
     * @description:收藏
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
     * @description:取消收藏
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
    
    /**
     * @description:获取用收藏的文章
     * @author wuyanwen(2017年9月20日)
     */
    public function getStoreArticles($user_id, $limit = 10, $offset = 0)
    {
        return self::$store::where('store.user_id', '=', $user_id)
                            ->leftjoin('articles', 'store.aid', '=', 'articles.id')
                            ->select('articles.id as aid','articles.title', 'articles.user_id', 'articles.author', 'articles.category', 'articles.cid')
                            ->orderBy('store.created_at', 'DESC')
                            ->offset($offset * $limit)
                            ->limit($limit)
                            ->get();
    }
    
    /**
     * @description:获取用户收藏文章的总数
     * @author wuyanwen(2017年9月20日)
     * @param unknown $id
     */
    public function getTotalStore($user_id)
    {
        return self::$store::where('user_id', '=', $user_id)->count();
    }
}
