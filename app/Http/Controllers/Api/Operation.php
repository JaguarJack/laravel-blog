<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Request;
use App\Repository\LikeRepository;
use App\Repository\StoreRepository;
use App\Repository\AttendRepository;
use Illuminate\Support\Facades\DB;
use App\Repository\ArticleRelateRepository;

class Operation
{
    
    protected $article_relate;
    
    public function __construct(ArticleRelateRepository $article_relate)
    {
        $this->article_relate = $article_relate;
    }
    /**
     * 
     * @description:点赞操作
     * @author wuyanwen(2017年9月16日)
     * @param@param Request $request
     * @param@param LikeRepository $like
     * @param@return number[]
     */
    public function like(Request $request, LikeRepository $like)
    {
        $aid     = $request->input('aid');
        $user_id = $request->user('api')->id;

        if ($like->isLiked($user_id, $aid)) {
            DB::beginTransaction();
            
            if ($this->article_relate->decrementLikeNum($aid) && $like->cancel($user_id, $aid)) {
                DB::commit();
                return ['code' => 10000];
            } else {
                DB::rollback();
                return ['code' => 10001];
            }
        } else {
            DB::beginTransaction();
            
            if ($this->article_relate->incrementLikeNum($aid) && $like->like($user_id, $aid)) {
                DB::commit();
                return ['code' => 10000];
            } else {
                DB::rollback();
                return ['code' => 10001];
            }            
        }
    }
    
    /**
     * 
     * @description:收藏操作
     * @author wuyanwen(2017年9月16日)
     * @param@param Request $request
     * @param@param StoreRepository $store
     * @param@return number[]
     */
    public function store(Request $request, StoreRepository $store)
    {
        $aid     = $request->input('aid');
        $user_id = $request->user('api')->id;
        
        if ($store->isStored($user_id, $aid)) {
            DB::beginTransaction();
            
            if ($this->article_relate->decrementStoreNum($aid) && $store->cancel($user_id, $aid)) {
                DB::commit();
                return ['code' => 10000];
            } else {
                DB::rollback();
                return ['code' => 10001];
            }
        } else {
            DB::beginTransaction();
            
            if ($this->article_relate->incrementStoreNum($aid) && $store->store($user_id, $aid)) {
                DB::commit();
                return ['code' => 10000];
            } else {
                DB::rollback();
                return ['code' => 10001];
            }
        }
    }
    
    
    /**
     * 
     * @description:关注
     * @author wuyanwen(2017年9月16日)
     * @param@param Request $request
     * @param@param LikeRepository $like
     */
    public function attend(Request $request, AttendRepository $attend)
    {
        $attend_user_id = $request->input('attend_user_id');
        $user_id = $request->user('api')->id;

        return $attend->isAttended($user_id, $attend_user_id) ?
        
                $attend->cancel($user_id, $attend_user_id) ?
                ['code' => 10000] : ['code' => 10001]
                
                : $attend->attend($user_id, $attend_user_id)  ?
                
                ['code' => 10000] : ['code' => 10001];
    }

}
