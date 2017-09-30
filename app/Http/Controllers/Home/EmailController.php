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
        
       $user = $this->request->user('home');
       
       if ($user->activation == 2) {
           return $this->ajaxError('邮箱已经激活过了~');
       }
       
       return $this->email->sendEmail($user) ? $this->ajaxSuccess('邮件发送成功,可能稍有延迟请耐心等待') :
                    
                            $this->ajaxError('邮件已发送，请于二十四小时内至邮箱激活');
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
        $user = $this->request->user('home');
        
        $result = $this->email->avtive($user->id, $code, $type);
        
        if ($result) {
            Log::info('邮箱激活成功~', ['user' => $user->user_name,'time' => date('Y-m-d H:i:s')]);
            redirect('/user/activation');
        } else {
            Log::info('邮箱激活失败~', ['user' => $user->user_name,'time' => date('Y-m-d H:i:s')]);
            $this->error(404, '邮箱激活失败');
        }
    }
}
