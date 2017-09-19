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
}
