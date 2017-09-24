<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Request;
use App\Repository\TagsRepository;
use Cache;

class Tags
{
    //
    protected $tags;
    
    public function __construct(TagsRepository $tags)
    {
        $this->tags= $tags;
    }
    
    /**
     * 
     * @description:获取所有tags
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    public function getTags()
    {
        if (Cache::has('tags') && Cache::get('tags')) {
            $tags = Cache::get('tags');
        } else {
            $tags= $this->tags->getTags();
            Cache::put('tags', $tags, 60 * 24);
        }
        
        return [
            'data' => $tags,
        ];
    }
    
}
