<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\LikeRepository;

class LikeController extends Controller
{
    //
    /**
     * @description:获取喜欢的文章
     * @author wuyanwen(2017年9月20日)
     * @param Request $request
     */
    public function getLikeArticles(Request $request, LikeRepository $like)
    {
        $page = intval($request->input('page'));
        
        $user_id = intval($request->input('user_id'));
        
        return $this->ajaxSuccess('', $like->getLikeArticles($user_id, 10 ,$page - 1)->toArray());
    }
}
