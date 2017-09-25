<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Service\EmailService;

class EmailController extends Controller
{
    protected $request;
    protected $email;
    /**
     * 
     * @description:
     * @author wuyanwen(2017年9月21日)
     * @param
     */
    public function __construct(Request $request, EmailService $email)
    {
        $this->request = $request;
        $this->email   = $email;
    }
    /**
     * @description:发送邮箱验证
     * @author wuyanwen(2017年9月21日)
     * @param Request $request
     * @param UsersRepository $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function send()
    {
       $this->email->sendEmail($this->request);
       $this->ajaxSuccess('发送成功');
    }
    
    /**
     * 
     * @description:注册邮件激活确认
     * @author wuyanwen(2017年9月21日)
     * @param@param unknown $type
     * @param@param unknown $code
     */
    public function confirm($type, $code)
    {
        return $this->email->avtive($type, $code, $this->request->user()->id) ?
        
        
        redirect('/') :  redirect('/');
    }
}
