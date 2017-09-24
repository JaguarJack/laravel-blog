<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\CommentRepository;
use App\Repository\ArticleRepository;

class CommentController extends Controller
{
    //
    
    /**
     * @description:获取用户评论
     * @author wuyanwen(2017年9月20日)
     */
    public function getComments(Request $request, CommentRepository $comment)
    {
        $page = intval($request->input('page'));
        $user_id = intval($request->input('user_id'));
        
        return $this->ajaxSuccess('' , $comment->getComments($user_id, 10, $page - 1)->toArray());
    }
    
    /**
     * @description:获取文章评论
     * @author wuyanwen(2017年9月22日)
     * @param Request $request
     * @param ArticleRepository $article
     */
    public function getArticleComment(Request $request, ArticleRepository $article)
    {
        $page = intval($request->input('page'));
        $aid  = intval($request->input('aid'));
        
        return ['data' =>  $article->getComments($aid,($page-1))->toArray(),
                'pages' => $article->getTotalOfComment($aid),
        ];
        
    }
}
