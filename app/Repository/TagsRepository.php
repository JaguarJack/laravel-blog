<?php

namespace App\Repository;

use App\Model\Tags;

class TagsRepository
{
    //
    protected static $tags;
    
	public function __construct(Tags $tags)
	{
	    self::$tags = $tags;
	}
	
	/**
	 * @description:获取标签文章
	 * @author wuyanwen(2017年9月19日)
	 * @param unknown $tag_name
	 * @return unknown
	 */
	public function getTagsRelateArticle($tagname)
	{
	    $tags = self::$tags::where('name', '=', $tagname)->first();
	    
	    return $tags ? $tags->hasManyArticles : [];
	}
	
	/**
	 * 
	 * @description:获取某个标签下文章总数
	 * @author wuyanwen(2017年9月20日)
	 * @param@param unknown $tagname
	 * @param@return array
	 */
	public function getTagTotalArticles($tagname)
	{
	    $tags = self::$tags::where('name', '=', $tagname)
	                       ->leftjoin('tags_relate', 'tags.id', '=','tags_relate.tag_id')
	                       ->count();
	}
	
	/**
	 * 
	 * @description:获取标签文章
	 * @author wuyanwen(2017年9月20日)
	 * @param@param unknown $tagname
	 * @param@param unknown $offset
	 * @param@param unknown $limt
	 */
	public function getTagArticle($tagname, $offset = 0, $limit = 10)
	{
	    $where = [
	        ['name', '=', $tagname],
	        ['articles.status', '=', 3],
	    ];
	    
	    return self::$tags::where($where)
                    	    ->leftjoin('tags_relate', 'tags.id', '=','tags_relate.tag_id')
                    	    ->leftjoin('articles', 'articles.id', '=', 'tags_relate.aid')
                    	    ->leftjoin('article_relate', 'articles.id', '=', 'article_relate.aid')
                    	    ->select('articles.title','articles.intro','articles.id','articles.author','articles.category','article_relate.*')
                    	    ->offset($offset * $limit)
                    	    ->limit($limit)
                    	    ->orderBy('articles.created_at', 'DESC')
                    	    ->get();
	}
}
