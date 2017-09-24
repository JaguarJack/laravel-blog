<?php

namespace App\Service;

use DB;
use App\Repository\ArticleRepository;
use App\Repository\TagsRepository;
use App\Repository\ArticleRelateRepository;
use App\Repository\TagsRelateRepository;

class ArticleService
{
    protected $article;
    protected$tag;
    protected$article_relate;
    protected$tags_relate;
    
    public function __construct(ArticleRepository $article,
        TagsRepository $tag, ArticleRelateRepository $article_relate,
        TagsRelateRepository $tags_relate){
        $this->article = $article;
        $this->tag     = $tag;
        $this->article_relate = $article_relate;
        $this->tags_relate    = $tags_relate;
    }
    
    /**
     *
     * @description:通过文章
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    public function pass($data)
    {
        $article = $this->article->find($data['id']);
        $tags    = explode(',', $article->tags);
        $tags    = $this->getNotExistTag($tags);
        
        DB::beginTransaction();
        
        //更新文章信息
        if ($this->article->update($data)) {
            DB::rollback();
            return false;
        }
        //存储tags
        if (count($tags)) {
            foreach ($tags as $name) {
                //添加tag记录
                $id = $this->tag->store($name);
                if (!$id) {
                    DB::rollback();
                    return false;
                }
                //添加tag关联记录
                if (!$this->tags_relate->store($id, $data['id'], $article->user_id)) {
                    DB::rollback();
                    return false;
                }
            }
        }
        
        //添加文章关联
        if (!$this->article_relate->store($data['aid'], $article->user_id)) {
            DB::rollback();
            return false;
        }
        
        DB::commit();
        return true;
    }
    
    /**
     * 
     * @description:返回未存在的tags
     * @author wuyanwen(2017年9月24日)
     * @param@param unknown $tags
     */
    protected function getNotExistTag($tags, TagsRepository $tag)
    {
        foreach ($tags as $key => $name) {
            if ($this->tag->getTagByName($name)) unset($tags[$key]);
        }
        
        return $tags;
    }
}
