<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     *
     * @author:wuyanwen
     * @description:ajax错误相应
     * @date:2017年9月3日
     * @param unknown $data
     */
    protected function ajaxError($msg = '', array $data = [])
    {
        return response()->json([
            'status' => 10001,
            'msg'    => $msg,
            'data'   => $data,
        ]);
    }
    
    /**
     *
     * @author:wuyanwen
     * @description:ajax成功相应
     * @date:2017年9月3日
     * @param unknown $data
     */
    protected function ajaxSuccess($msg = '', array $data = [])
    {
        return response()->json([
            'status' => 10000,
            'msg'    => $msg,
            'data'   => $data,
        ]);
    }
}
