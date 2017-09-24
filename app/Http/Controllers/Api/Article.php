<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Request;
use App\Repository\ArticleRepository;
use App\Repository\ArticleRelateRepository;
use Cache;

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
        
        return ['pages' => $this->article->total(),
                'data' => $this->article->getArticles($page-1)
        ];
    }
    
    
    /**
     * 
     * @description:获取文章列表
     * @author wuyanwen(2017年9月24日)
     * @param@param Request $request
     */
    public function getArticlesList(Request $request)
    {
        $params = $request->all();
        $offset = $params['page'] - 1;
        $limit  = $params['limit'];
        
        $where = [];
        
        if (isset($params['title']) && $params['title']) {
            $where[] = ['title', '=', $params['title']];
        }
        if (isset($params['author']) && $params['author']) {
            $where[] = ['author', '=', $params['author']];
        }
        if (isset($params['status']) && $params['status']) {
            $where[] = ['status', '=', $params['status']];
        }
        
        $data = $this->article->getArticlePages($offset, $limit, $where);
        
        $list = $data['data'];
        
        foreach ($list as $key => $vo) {
            switch ($vo->status) {
                case 1:
                    $list[$key]->status = '草稿';
                    break;
                case 2:
                    $list[$key]->status = '待审核';
                    break;
                case 3:
                    $list[$key]->status = '通过';
                    break;
            }
        }
        
        return [
            'code' => 0,
            'msg'  => '',
            'count' => $data['total'],
            'data'  => $list,
        ];
    }
    
    /**
     * 
     * @description:获取热门文章
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    public function getHotArticles(ArticleRelateRepository $article_relate)
    {
        if (Cache::has('hot') && Cache::get('hot')) {
            $hot_aritcles = Cache::get('hot');
        } else {
            $hot_aritcles= $article_relate->getHotArticles();
            Cache::put('hot', $hot_aritcles, 60 * 24);
        }
        
        return [
            'data' => $hot_aritcles,
        ];
    }
}
