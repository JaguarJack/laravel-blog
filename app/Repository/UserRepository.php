<?php

namespace App\Repository;

use App\Model\User;

class UserRepository
{
    protected static $user;
    
    public function __construct(User $user)
    {
        self::$user = $user;
    }
    /**
     *
     * @author:wuyanwen
     * @description:创建用户
     * @date:2017年9月2日
     * @param array $data
     * @return unknown
     */
    public function store(array $data)
    {
        return self::$user::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
    }
    
    /**
     *
     * @author:wuyanwen
     * @description:用户分页
     * @date:2017年9月3日
     * @param unknown $page
     */
    public function page($offset=0, $limit = 15, $where = [])
    {
        $data = self::$user::where($where)
                        ->select('id','name','email','created_at')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();
        
        $total = self::$user::where($where)->count();
        
        return ['data' => $data, 'total' => $total];
    }
    
    /**
     *
     * @author:wuyanwen
     * @description:查找记录
     * @date:2017年9月3日
     */
    public function find($field, $value)
    {
        return self::$user::where($field, $value)->first();
    }
    
    /**
     * @description:删除一条记录
     * @author wuyanwen(2017年9月5日)
     * @param unknown $id
     * @return unknown
     */
    public function delete($id)
    {
       return self::$user::destroy($id); 
    }
    
    /**
     * @description:
     * @author wuyanwen(2017年9月6日)
     */
    public function update($data)
    {
        $user = self::$user::find($data['id']);
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        
        if ($data['password']) {
            $user->password = $data['password'];
        }
        
        return $user->save();
    }
}