<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\ArticleRepository;

class ArticleController extends Controller
{
    //
    
    
    public function getUserArticles(Request $request, ArticleRepository $article)
    {
        $page = intval($request->input('page')) - 1;
        $user_id = $request->input('user_id');
        
        return $this->ajaxSuccess('获取成功', $article->getUserArticles($user_id, $page)->toArray());
    }
}
