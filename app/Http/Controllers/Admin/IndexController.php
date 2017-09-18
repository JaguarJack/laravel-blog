<?php

namespace App\Http\Controllers\Admin;


class IndexController extends BaseController
{    
    /**
     * 
     * @author:wuyanwen
     * @description:后台首页
     * @date:2017年9月2日
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('admin.index.index');
    }
    
    /**
     * 
     * @author:wuyanwen
     * @description:后台主面板
     * @date:2017年9月2日
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function main()
    {
        return view('admin.index.main');
    }
}