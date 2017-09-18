<?php

namespace App\Repository;

use App\Model\Article;

class ArticleRepository
{
    //
    protected static $article;
    
    public function __construct(Article $article)
	{
        self::$article = $article;
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
     */
    public function getArticles($offset = 0, $limit = 0)
    {
        return self::$article::where('articles.status', '=' , self::$article::PASS_STATUS)
                              ->select('articles.*', 'article_relate.*')
                              ->leftjoin('article_relate', 'articles.id', '=', 'article_relate.aid')
                              ->offset($offset * ($limit ? : self::$article::LIMIT))
                              ->limit($limit ? : self::$article::LIMIT)
                              ->orderBy('articles.id', 'DESC')
                              ->get();
                
    }
    
    
    /**
     * @description:总页码
     * @author wuyanwen(2017年9月14日)
     * @return number
     */
    public function total($limit = 0)
    {
        return self::$article::where('status', '=', self::$article::PASS_STATUS)->count() 
        
        
                            / ($limit ? : self::$article::LIMIT);
    }
    
    /**
     * 
     * @description:
     * @author wuyanwen(2017年9月14日)
     * @param $id
     */
    public function getComments($id)
    {
        $where  = [
            ['status','=', self::$article::PASS_STATUS],
        ];
        //dd(self::$article::where($where)->find($id));
        return self::$article::where($where)->find($id)->hasManyComments;
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
    
    
    public function store($data)
    {
        return self::$article::create([
            'cid' => 1, 
            'fid' => 0,
            'user_id' =>2,
            'author' => $data['name'],
            'category' => 'php',
            'intro'   => '试一试',
            'title'   => '试一试', 
            'thumb_img' => '' , 
            'tags'      => 'dd',
            'content'   => $data['content'],
            'status' => 3,
        ]);
    }
}
