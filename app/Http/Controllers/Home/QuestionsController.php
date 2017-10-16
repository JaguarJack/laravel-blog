<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Repository\QuestionsRepository;

class QuestionsController extends Controller
{
    /**
     * @description:问答页面
     * @author wuyanwen(2017年9月13日)
     * @param ArticleRepository $article
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($status, QuestionsRepository $questions)
    {
        return view('home.questions.index',[
            'total'  => $questions->getTotalQuestions(),
            'status' => $status,
        ]);
    }
    
    /**
     * @description:问答详情
     * @author wuyanwen(2017年10月16日)
     * @param unknown $id
     */
    public function question($id)
    {
        
    }
    
    
    /**
     * @description:解答
     * @author wuyanwen(2017年10月16日)
     */
    public function answer(Request $request)
    {
        
    }
    
    /**
     * @description:问题提交
     * @author wuyanwen(2017年10月16日)
     */
    public function submit()
    {
        
    }
}
