<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Request;
use App\Repository\ArticleRepository;

class Article
{
    //
    protected $article;
    
    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }
    
    /**
     *
     * @description:动态获取文章信息
     * @author wuyanwen(2017年9月10日)
     * @param@param Request $request
     */
    public function getArticles(Request $request)
    {
        $page = $request->input('page');
        
        return ['pages' => $this->article->total(),'data' => $this->article->getArticles($page-1)];
    }
}
