<?php

namespace App\Repository;

use App\Model\TagsRelate;

class TagsRelateRepository
{
    //
    protected static $tags_relate;
    
    public function __construct(TagsRelate $tags_relate)
	{
        self::$tags_relate = $tags_relate;
    }
    
    /**
     * 
     * @description:记录关联记录
     * @author wuyanwen(2017年9月24日)
     * @param@param unknown $tag_id
     * @param@param unknown $aid
     * @param@param unknown $user_id
     * @param@return unknown
     */
    public function store($tag_id, $aid, $user_id)
    {
        return self::$tags_relate::create([
           'tag_id'   => $tag_id,
            'aid'     => $aid,
            'user_id' => $user_id,
        ]);
    }
}
