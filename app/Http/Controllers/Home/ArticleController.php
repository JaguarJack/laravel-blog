<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\ArticleRepository;

class ArticleController extends Controller
{
    //
    
    /**
     * 
     * @description:获取用户文章
     * @author wuyanwen(2017年9月20日)
     * @param@param Request $request
     * @param@param ArticleRepository $article
     * @param@return \Illuminate\Http\JsonResponse
     */
    public function getUserArticles(Request $request, ArticleRepository $article)
    {
        $page = intval($request->input('page')) - 1;
        $user_id = $request->input('user_id');
        
        return $this->ajaxSuccess('获取成功', $article->getUserArticles($user_id, $page)->toArray());
    }
    
    /**
     * 
     * @description:获取分类文章
     * @author wuyanwen(2017年9月20日)
     * @param@param Request $request
     * @param@param ArticleRepository $article
     */
    public function getCategory(Request $request, ArticleRepository $article)
    {
        $category = intval($request->input('category_id'));
        $page     = intval($request->input('page'));
        
        return $this->ajaxSuccess('', $article->getArticles($page - 1, 10, $category)->toArray());
    }
}
