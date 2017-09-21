<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Service\EmailService;

class EmailController extends Controller
{
    //
  
    
    /**
     * @description:发送邮箱验证
     * @author wuyanwen(2017年9月21日)
     * @param Request $request
     * @param UsersRepository $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request, EmailService $email)
    {
       $email->sendEmail($request);
       $this->ajaxSuccess('发送成功');
    }
}
