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
    public function aduit(Request $request, ArticleService $article)
    {
        $data = [
            'id'     => intval($request->input('aid')),
            'status' => 3,
        ];
        
        return $article->pass($data) ? $this->ajaxSuccess('审核通过') : 
        
                                $this->ajaxError('审核失败');
    }
    
    /**
     * 
     * @description:不通过
     * @author wuyanwen(2017年9月24日)
     * @param
     */
    public function notPass(Request $request, ArticleRepository $article)
    {
        $aid  = $request->input('aid');
        
        $data = [
            'id'     => intval($aid),
            'status' => 1,
        ];
        
        return $article->update($data) ? $this->ajaxSuccess('更新成功') : 
        
                                $this->ajaxError('更新失败');
    }
}
