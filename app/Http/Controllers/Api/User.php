<?php

namespace App\Http\Controllers\Api;

use App\Repository\UserRepository;
use Illuminate\Http\Request;

class User
{
    protected $user;
    
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    
    /**
     * 
     * @description:用户分页列表
     * @author wuyanwen(2017年9月24日)
     * @param@param Request $request
     * @param@return number[]|string[]|NULL[]|unknown[]
     */
    public function page(Request $request)
    {
        
        $params = $request->all();
        $offset = $params['page'] - 1;
        $limit  = $params['limit'];
        
        $where = [];
        
        if (isset($params['name']) && $params['name']) {
            $where[] = ['name', '=', $params['name']];
        }
        if (isset($params['email']) && $params['email']) {
            $where[] = ['email', '=', $params['email']];
        }
       
        $data = $this->user->page($offset * $limit, $limit, $where);

        return [
            'code' => 0,
            'msg'  => '',
            'count' => $data['total'],
            'data'  => $data['data'],
        ];
    }
}