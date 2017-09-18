<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Request;
use App\Repository\UsersRepository;
use App\Service\UsersService;

class Users
{
    protected $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }
    
    /**
     * 
     * @description:获取用户
     * @author wuyanwen(2017年9月10日)
     * @param
     */
    public function getUsers(Request $request, UsersService $service)
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
        if (isset($params['type']) && $params['type']) {
            $where[] = ['type', '=', $params['type']];
        }
        
        $data = $this->users->page($offset, $limit, $where);
        
        $_data = $data['data']->toArray();
        
        foreach ($_data as $key => $vo) {
            $_data[$key]['type'] = $service->getReigsterType($vo['type']);
            $_data[$key]['sex']  = $vo['sex'] == 1 ? '男' : '女';
            $_data[$key]['activation'] = $vo['activation'] == 1 ? '未激活' : '激活';
            $_data[$key]['status'] =$vo['activation'] == 1 ? '正常' : '禁止';
        }
        
        return [
            'code' => 0,
            'msg'  => '',
            'count' => $data['total'],
            'data'  => $_data,
        ];
    }
    
    /**
     * 
     * @description:禁止/解禁用户
     * @author wuyanwen(2017年9月10日)
     * @param@param Request $request
     */
    public function forbidden(Request $request)
    {
       return $this->users->forbidden($request->all()['id']) ? 
       
              response()->json([
                  'code' => '10000',
                  'msg'  => '更新成功',
              ]) : response()->json([
                  'code' => '10001',
                  'msg'  => '更新失败',
              ]) ;
    }
}
