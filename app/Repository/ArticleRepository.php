<?php

namespace App\Repository;

use App\Model\Article;
use DB;

class ArticleRepository
{
    //
    protected static $article;
    
    public function __construct(Article $article)
	{
        self::$article = $article;
    }
    
    /**
     * @description:根据ID查找记录
     * @author wuyanwen(2017年9月26日)
     * @param unknown $id
     */
    public function findById($id)
    {
        return self::$article::find($id);
    }
    /**
     * 
     * @description:查找一条记录
     * @author wuyanwen(2017年9月12日)
     * @param@param unknown $id
     * @param@return unknown
     */
    public function find($id)
    {
        $where  = [
            ['articles.id', '=', $id],
            ['articles.status','=', self::$article::PASS_STATUS],
        ];

        return self::$article::where($where)->select('article_relate.*','users.*','articles.*')
                                            ->leftjoin('article_relate', 'articles.id', '=', 'article_relate.aid')
                                            ->leftjoin('users', 'articles.user_id', '=', 'users.id')
                                            ->first(); 
    }
    
    /**
     * @description:获取limit文章
     * @author wuyanwen(2017年9月13日)
     * @param number $offset
     * @param number $limit
     * @param number $category_id 获取分类文章
     */
    public function getArticles($offset = 0, $limit = 0, $category_id = 0, $type = true)
    {
        $where = [
            ['articles.status', '=' , self::$article::PASS_STATUS],
        ];
        
        if ($category_id) {
            $where[] = [ $type ? 'cid' : 'fid', '=', $category_id];
        }
        
        return self::$article::where($where)
                              ->select('articles.*', 'article_relate.*')
                              ->leftjoin('article_relate', 'articles.id', '=', 'article_relate.aid')
                              ->offset($offset * ($limit ? : self::$article::LIMIT))
                              ->limit($limit ? : self::$article::LIMIT)
                              ->orderBy('articles.id', 'DESC')
                              ->get();
                
    }
    
    /**
     * 
     * @description:后台文章管理
     * @author wuyanwen(2017年9月24日)
     * @param@param number $offset
     * @param@param number $limit
     */
    public function getArticlePages($offset = 0, $limit = 10 , array $condition = [])
    {
        $data = self::$article::where($condition)
                    ->select('articles.*')
                    ->offset($offset * ($limit ? : self::$article::LIMIT))
                    ->limit($limit ? : self::$article::LIMIT)
                    ->orderBy('articles.id', 'DESC')
                    ->get();
        
         $total = self::$article::where($condition)->count();
         
         return ['data' => $data, 'total' => $total];
    }
    
    /**
     * @description:总页码
     * @author wuyanwen(2017年9月14日)
     * @return number
     */
    public function total($limit = 0)
    {
        return ceil($this->getTotalArticles() / ($limit ? : self::$article::LIMIT));
    }
    
    /**
     * 
     * @description:获取文章总数
     * @author wuyanwen(2017年9月24日)
     * @param@return unknown
     */
    public function getTotalArticles()
    {
        return self::$article::where('status', '=', self::$article::PASS_STATUS)->count();
    }
    
    /**
     * 
     * @description:获取分类文章总数
     * @author wuyanwen(2017年9月20日)
     * @param@param unknown $category_id
     */
    public function getCategotyTotal($category_id, $type = true)
    {
        $where = [
            [$type ? 'cid' : 'fid', '=', $category_id],
            ['status', '=', self::$article::PASS_STATUS],
        ];
        
        return self::$article::where($where)->count();
    }
    /**
     * 
     * @description:
     * @author wuyanwen(2017年9月14日)
     * @param $id
     */
    public function getComments($id, $offset, $limit = 10)
    {
        $where  = [
            ['status','=', self::$article::PASS_STATUS],
        ];

        return self::$article::where($where)
                             ->find($id)
                             ->hasManyComments()
                             ->offset($offset * $limit)
                             ->limit($limit)
                             ->get();
    }
    
    /**
     * 
     * @description:获取文章总评论数
     * @author wuyanwen(2017年9月23日)
     * @param
     */
    public function getTotalOfComment($id, $limit = 10)
    {
        
        $where  = [
            ['status','=', self::$article::PASS_STATUS],
        ];
        
        $total =  self::$article::where($where)
                            ->find($id)
                            ->hasManyComments()
                            ->count();
        
       return ceil($total / $limit);
    }
    /**
     * 
     * @description:查询上一篇 &&下一篇
     * @author wuyanwen(2017年9月14日)
     * @param@param unknown $id
     */
    public function getPreAndNext($id)
    {
        $where = [
            ['status', '=', self::$article::PASS_STATUS],
        ];

        return [
            self::$article::where(array_merge($where, [['id', '>', $id]]))->first(),
            self::$article::where(array_merge($where, [['id', '<', $id]]))->orderBy('id', 'DESC')->first(),
        ];

    }
    
    
    /**
     * @description:获取用户文章
     * @author wuyanwen(2017年9月19日)
     * @param number $offset
     * @param number $limit
     * @return unknown
     */
    public function getUserArticles($user_id, $offset = 0, $limit = 0)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['status', '=', self::$article::PASS_STATUS],
        ];
        
        return self::$article::where($where)
                            ->select('articles.title', 'articles.author','articles.id','articles.intro', 'articles.created_at')
                            ->offset($offset * ($limit ? : self::$article::LIMIT))
                            ->limit($limit ? : self::$article::LIMIT)
                            ->orderBy('articles.id', 'DESC')
                            ->get();
        
    }
    /**
     * @description:获取用户文章总页码
     * @author wuyanwen(2017年9月19日)
     * @param unknown $user_id
     * @param unknown $limit
     * @return number
     */
    public function getTotalAritcle($user_id, $limit = null)
    {
        
        $where = [
            ['user_id', '=', $user_id],
            ['status', '=', self::$article::PASS_STATUS],
        ];
        
        $total = self::$article::where($where)->count();
        
        return ['total' => $total, 'pages'=> ceil($total/ ($limit ? : self::$article::LIMIT))];
    }
    
    /**
     * @description:保存文章记录
     * @author wuyanwen(2017年9月18日)
     * @param unknown $data
     * @return unknown
     */
    public function store($data)
    {
        return self::$article::create($data);
    }
    
    /**
     * 
     * @description:获取用户未通过或者草稿文章
     * @author wuyanwen(2017年9月24日)
     * @param@param unknown $user_id
     */
    public function getNotPassByUserId($user_id)
    {
        $where = [
            ['user_id', '=', $user_id],
            ['status', '<', self::$article::PASS_STATUS],
        ];
        
        return self::$article::where($where)->count();
    }
    
    /**
     * 
     * @description:更新
     * @author wuyanwen(2017年9月24日)
     * @param@param unknown $data
     */
    public function update($data)
    {
        $article = $this->findById($data['id']);
        unset($data['id']);
        
        foreach ($data as $field => $value)
        {
            $article->{$field} = $value;
        }
        
        return $article->save();
    }
}
