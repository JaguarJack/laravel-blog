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
        $article = $this->article->findById($data['id']);
        //过滤已存在的tag
        $tags    = explode(',', trim($article->tags));
        $tags    = $this->getNotExistTag($tags);
        //开启事务
        DB::beginTransaction();
        //业务处理
        try {
            if (!$this->article->update($data)) {
                throw new \Exception('更新文章状态失败');
            }
            //存储tags
            if (count($tags)) {
                foreach ($tags as $name) {
                    //添加tag记录
                    $result = $this->tag->store($name);
                    if (!$result) {
                        throw new \Exception('添加标签失败');
                    }
                    //添加tag关联记录
                    if (!$this->tags_relate->store($result->id, $data['id'], $article->user_id)) {
                        throw new \Exception('添加标签关联失败');
                    }
                }
            }
            //添加文章关联
            if (!$this->article_relate->store($data['id'], $article->user_id)) {
                throw new \Exception('添加文章关联失败');
            }
        } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
        }
        //事务提交
        DB::commit();
        return '审核通过';
    }
    
    /**
     * 
     * @description:返回未存在的tags
     * @author wuyanwen(2017年9月24日)
     * @param@param unknown $tags
     */
    protected function getNotExistTag($tags)
    {
        foreach ($tags as $key => $name) {
            if ($this->tag->getTagByName($name)) unset($tags[$key]);
        }
        
        return $tags;
    }
}
