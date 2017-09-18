<?php

namespace App\Service;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;

class UsersService
{
    protected $type = [
        1 => '注册用户',
        2 => 'QQ用户',
        3 => '微博用户',
        4 => '其他',
    ];
    
    protected $category;
    protected $article;
    public function __construct(CategoryRepository $category, ArticleRepository $article)
    {
        $this->category = $category;
        $this->article  = $article;
    }
    
    /**
     * @description:返回用户类型
     * @author wuyanwen(2017年9月13日)
     * @param unknown $type_id
     * @return string
     */
    public function getReigsterType($type_id)
    {
        return $this->type[$type_id];
    }
    
    /**
     * @description:发布文章
     * @author wuyanwen(2017年9月18日)
     * @param CategoryRepository $category
     * @param ArticleRepository $article
     */
    public function publish($request)
    {
        $category = $this->category->find('id', $request->input('category'));

        $user = $request->user('home');
        //dd($request->input('tags'));
        $data = [
            'cid'      => $category->id,
            'fid'      => $category->fid,
            'title'    => $request->input('title'),
            'tags'     => strpos('，', $request->input('tgas')) ? str_replace('，', ',', $request->input('tags')) : $request->input('tags'),
            'content'  => $request->input('content'),
            'intro'    => $request->input('intro'),
            'user_id'  => $user->id,
            'author'   => $user->user_name,
            'category' => $category->name,
            'status'   => $request->input('status'),
        ];
        
        return $this->article->store($data);
    }
    
    /**
     * @description:获取分类
     * @author wuyanwen(2017年9月18日)
     */
    public function getCategory()
    {
        return $this->category->getCates([['fid', '<>', 0]]);
    }
}
