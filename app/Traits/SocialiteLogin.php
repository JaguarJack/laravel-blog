<?php

namespace App\Traits;

use Socialite;
use App\Repository\UsersRepository;
use Auth;

Trait SocialiteLogin
{
    use Response;
    
    public function oauth($driver)
    {
        $this->notFoundDirver($driver);
        
        return Socialite::driver($driver)->redirect();
    }
    
    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function callback($dirver)
    {
        $user = Socialite::driver($dirver)->user();

        //是否注册过
        if ( !$this->isRegisterd($user->id) && !$this->register($user, $dirver)) {
                $this->error(404, '授权失败，请重新尝试~');
        }
        
        //登录
        $attempt = [
            'open_id' => $user->id,
            'password' => config('services.oauth.password'),
        ];
        
        if (Auth::guard('home')->check()) {
            return redirect($this->redirectTo());
        } else {
            if (Auth::guard('home')->attempt($attempt, true)) {
                return redirect($this->redirectTo());
            } else {
                $this->error(404, '登录失败,请重新尝试~');
            }
        }
    }
    
    /**
     * @description:获取用户类型
     * @author wuyanwen(2017年9月28日)
     * @param unknown $driver
     */
    protected function getUserType($driver)
    {
        switch ($driver) {
            case 'qq':
                return 2;
                break;
            case 'sina':
                return 3;
                break;
            case 'github':
                return 4;
                break;
            default:
                return 5;
        }
    }
    
    /**
     * @description:注册用户
     * @author wuyanwen(2017年9月28日)
     * @param unknown $user
     */
    protected function register($user, $driver)
    {
        $email = $user->email ? $this->user->findUserByField('email', $user->email) ? '' : $user->email : '';
        
        $user_info = [
            'user_name' => $user->nickname,
            'avatar'    => $user->avatar,
            'email'     => $email,
            'password'  => bcrypt(config('services.oauth.password')),//为每位授权用户设置默认密码  => auth认证
            'open_id'   => $user->id,
            'type'      => $this->getUserType($driver),
            'api_token' => substr(encrypt(str_random(rand(30,40))),1,40),
        ];
        
        //github存储额外的信息
        if ($driver == 'github') {
            $user_info['github_name']     = $user->nickname;
            $user_info['github_homepage'] = $user->user['html_url'];
            $user_info['website']         = $user->user['blog'] ?? '';
            $user_info['introduction']    = $user->user['bio'] ?? '';
            
        }
        return $this->user->storeOauthUser($user_info);
    }
    
    /**
     * @description:授权用户是否注册过
     * @author wuyanwen(2017年9月28日)
     */
    protected function isRegisterd($open_id)
    {
        return $this->user->findUserByField('open_id', $open_id) ? true : false;
    }
    
    /**
     * @description:支持的登录方式
     * @author wuyanwen(2017年9月28日)
     * @param unknown $dirver
     */
    protected function notFoundDirver($dirver)
    {
        if ( !in_array($dirver, config('services.oauth.driver')) ) {
            $this->error(404, '?不支持的该第三方登录');
        }
    }
}