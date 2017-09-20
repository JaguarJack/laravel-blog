<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\CommentRepository;

class CommentController extends Controller
{
    //
    
    /**
     * @description:获取评论
     * @author wuyanwen(2017年9月20日)
     */
    public function getComments(Request $request, CommentRepository $comment)
    {
        $page = intval($request->input('page'));
        $user_id = intval($request->input('user_id'));
        
        return $this->ajaxSuccess('获取成功' , $comment->getComments($user_id, 10, $page - 1)->toArray());
    }
}
