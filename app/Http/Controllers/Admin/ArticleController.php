<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Repository\ArticleRepository;
use App\Service\ArticleService;

class ArticleController extends BaseController
{
    /**
     * 
     * @description:文章首页
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    public function index()
    {
        return view('admin.article.index');
    }
    
    /**
     * 
     * @description:审核
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    public function pass(Request $request, ArticleService $article)
    {
        return $this->ajaxSuccess($article->pass([
                'id'     => intval($request->input('id')),
                'status' => 3,
        ]));

    }
    
    /**
     * 
     * @description:不通过
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    public function notPass(Request $request, ArticleRepository $article)
    {
        $aid  = $request->input('id');
        
        $data = [
            'id'     => intval($aid),
            'status' => 1,
        ];
        
        return $article->update($data) ? $this->ajaxSuccess('更新成功') : 
        
                                $this->ajaxError('更新失败');
    }
}
