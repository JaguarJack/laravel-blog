<?php

namespace App\Traits;

Trait Response
{
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
    
    /**
     * @description:http 响应错误
     * @author wuyanwen(2017年9月28日)
     * @param unknown $code
     * @param unknown $message
     */
    protected function error($code, $message = 'Page Not Found')
    {
       return abort($code, $message);
    }
}