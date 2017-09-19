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
            'tags' => $tags->getTagsRelateArticle($tagname),
        ]);
    }
}
