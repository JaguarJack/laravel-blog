<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\TagsRepository;

class TagsController extends Controller
{
    //
    
    /**
     * @description:tags页面
     * @author wuyanwen(2017年9月19日)
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($tagname, TagsRepository $tags)
    {
        return view('home.tags.index',[
            'total' => $tags->getTagTotalArticles($tagname),
            'tagname' => $tagname,
        ]);
    }
    
    /**
     * 
     * @description:获取标签相关文章
     * @author wuyanwen(2017年9月20日)
     * @param@param Request $request
     * @param@param TagsRepository $tags
     */
    public function getTagArticles(Request $request, TagsRepository $tags)
    {
        $page = intval($request->input('page'));
        $tagname = trim($request->input('tagname'));
        
        return $this->ajaxSuccess('', $tags->getTagArticle($tagname, $page-1)->toArray());
    }
}
