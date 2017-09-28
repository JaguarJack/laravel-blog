<?php

namespace App\Socialite;

use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use App\Socialite\SocialManager;
use Laravel\Socialite\Two\User;
use GuzzleHttp\ClientInterface;
use function GuzzleHttp\json_decode;

class SinaProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * @date
     * {@inheritDoc}
     * @see \Laravel\Socialite\Two\AbstractProvider::getTokenUrl()
     */
    protected function getTokenUrl()
    {
        return 'https://api.weibo.com/oauth2/access_token';  
    }
    
    /**
     * @description:获取token信息
     * @author wuyanwen(2017年9月28日)
     * @return string
     */
    protected function getTokenInfoUrl()
    {
        return 'https://api.weibo.com/oauth2/get_token_info';
    }
    
    /**
     * @description:获取用户信息
     * @author wuyanwen(2017年9月28日)
     * @return string
     */
    protected function getUserInfoUrl()
    {
        return 'https://api.weibo.com/2/users/show.json';
    }
    /**
     * 
     * {@inheritDoc}
     * @see \Laravel\Socialite\Two\AbstractProvider::getAuthUrl()
     */
    public function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://api.weibo.com/oauth2/authorize', $state);
    }
    
    /**
     * Get the access token response for the given code.
     *
     * @param  string  $code
     * @return array
     */
    public function getAccessTokenResponse($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => ['Accept' => 'application/json'],
            $this->getPostKey() => array_merge($this->getTokenFields($code), ['grant_type' => 'authorization_code']),
        ]);

        return json_decode($response->getBody(), true);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Laravel\Socialite\Two\AbstractProvider::getUserByToken()
     */
    public function getUserByToken($token)
    {
        //获取token info
        $response = $this->getHttpClient()->post($this->getTokenInfoUrl(),[
            $this->getPostKey() => ['access_token' => $token],
        ]);
        $token_info = json_decode($response->getBody(), true);
        
        //获取user info
        $response = $this->getHttpClient()->get($this->getUserInfoUrl(),[
            'query' => ['access_token' => $token, 'uid' => $token_info['uid']],
        ]);
        $user = json_decode($response->getBody(), true);
        
        return $user;
    }
    
    /**
     * @description:获取post key
     * @author wuyanwen(2017年9月28日)
     * @return string
     */
    protected function getPostKey()
    {
        return (version_compare(ClientInterface::VERSION, '6') === 1) ? 'form_params' : 'body';
    }
    /**
     * 
     * {@inheritDoc}
     * @see \Laravel\Socialite\Two\AbstractProvider::mapUserToObject()
     */
    public function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'], 'nickname' => $user['name'], 'name' => Arr::get($user, 'name'),
            'email' => Arr::get($user, 'email'), 'avatar' => $user['profile_image_url'],
        ]);
    }
    
}