<?php

namespace Laravel\Socialite\Two;

use Illuminate\Support\Arr;
use function GuzzleHttp\json_decode;

class QqProvider extends AbstractProvider implements ProviderInterface
{
    
    public function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://graph.qq.com/oauth2.0/authorize', $state);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Laravel\Socialite\Two\AbstractProvider::getTokenUrl()
     */
    protected function getTokenUrl()
    {
      return 'https://graph.qq.com/oauth2.0/token';
    }
    
    
    protected function getOpenidUrl()
    {
        return 'https://graph.qq.com/oauth2.0/me';
    }
    
    protected function getUserUrl()
    {
        return 'https://graph.qq.com/user/get_user_info';
    }
    /**
     * Get the access token response for the given code.
     *
     * @param  string  $code
     * @return array
     */
    public function getAccessTokenResponse($code)
    {
        
        $response = $this->getHttpClient()->get($this->getTokenUrl(),[
            'query' => array_merge($this->getTokenFields($code), ['grant_type' => 'authorization_code']),
        ]);
        
        parse_str($response->getBody()->getContents(), $token);                 
        
        return $token;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Laravel\Socialite\Two\AbstractProvider::getUserByToken()
     */
    public function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->getOpenidUrl(),[
            'query' => ['access_token' => $token],
        ]);
   
        
        $params = $this->getUserQueryParam($token, $response->getBody()->getContents());
        
        $response = $this->getHttpClient()->get($this->getUserUrl(),[
            'query' => $params,
        ]);

        $user = json_decode($response->getBody()->getContents(), true);
        
        $user['openid'] = $params['openid'];
        
        return $user;
    }
    
    /**
     * @description:获取请求用户信息参数
     * @author wuyanwen(2017年9月27日)
     * @param unknown $token
     * @param unknown $openidStr
     */
    public function getUserQueryParam($token, $openidStr)
    {
        $openIdArr = $this->getOpenId($openidStr);
        
        return [
            'access_token'       => $token,
            'oauth_consumer_key' => $openIdArr['client_id'],
            'openid'             => $openIdArr['openid'],
        ];
    }
    
    /**
     * @description:获取openid
     * @author wuyanwen(2017年9月27日)
     * @param unknown $openidStr
     * @return mixed
     */
    protected function getOpenId($openidStr)
    {
        return json_decode(substr($openidStr,strpos($openidStr,'(')+1,-3),true);
    }
    /**
     * 
     * {@inheritDoc}
     * @see \Laravel\Socialite\Two\AbstractProvider::mapUserToObject()
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'openid' => $user['openid'], 'nickname' => $user['nickname'], 'name' => Arr::get($user, 'name'),
            'email' => Arr::get($user, 'email'), 'avatar' => $user['figureurl_2'],
        ]);
    }

}