<?php

namespace App\Repository;

use App\Model\Users;

class UsersRepository
{
    //
    protected static $users;
	public function __construct(Users $users)
	{
	    self::$users = $users;
	}
	
	/**
	 * 
	 * @description:分页信息
	 * @author wuyanwen(2017年9月10日)
	 * @param@param number $offset
	 * @param@param number $limit
	 * @param@param array $where
	 * @param@return unknown[]
	 */
	public function page($offset=0, $limit = 15, $where = [])
	{
	    $data = self::$users::where($where)
            	    ->select('id','user_name', 'email', 'avatar', 'city', 'type','gender', 'activation', 'status','created_at')
            	    ->offset($offset)
            	    ->limit($limit)
            	    ->get();
	    
        $total = self::$users::where($where)->count();
	    
	    return ['data' => $data, 'total' => $total];
	}
	
	/**
	 * 
	 * @description:查找记录
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $field
	 * @param@param unknown $value
	 */
	public function find($field, $value)
	{
	    return self::$users::where($field, '=', $value)->first();
	}
	
	/**
	 * 
	 * @description:注册用户
	 * @author wuyanwen(2017年9月16日)
	 * @param@param unknown $data
	 */
	public function store($data)
	{
	    return self::$users::create([
	        'user_name' => $data['name'],
	        'email'     => $data['email'],
	        'password'  => bcrypt($data['password']),
	        'api_token' => substr(encrypt(str_random(rand(30,40))),1,40),
	    ]);
	}
	
	/**
	 * @description:注册oauth用户
	 * @author wuyanwen(2017年9月28日)
	 */
	public function storeOauthUser($data)
	{
	    return self::$users::create($data);
	}
	
	/**
	 * 
	 * @description:禁止/解禁用户
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $id
	 */
	public function forbidden($id)
	{
	    $user = $this->find('id', $id);
	    
	    $user->status = $user->status == 1 ? 2 : 1;
	    
	    return $user->save();
	}
	/**
	 * 
	 * @description:删除一条记录
	 * @author wuyanwen(2017年9月10日)
	 * @param@param unknown $id
	 * @param@return boolean|NULL
	 */
	public function delete($id)
	{
	    return self::$users->delete([$id]);
	}
	
	/**
	 * 
	 * @description:查询用户文章
	 * @author wuyanwen(2017年9月14日)
	 * @param
	 */
	public function getArticles($id)
	{
	    $user = self::$users::where('id', '=', $id)->find($id);
	    
	    return $user ? $user->hasManyUserArticles : [];
	}

	
	/**
	 * 
	 * @description:更新用户信息
	 * @author wuyanwen(2017年9月19日)
	 * @param@param unknown $data
	 */
	public function update($data)
	{
	    $user = $this->find('id', $data['id']);
	    
	    unset($data['id']);
	    
	    foreach ($data as $key => $vo)
	    {
	        $user->$key = $vo;
	    }
	    
	    return $user->save();
	}
	
	/**
	 * @description:根据用户field查找
	 * @author wuyanwen(2017年9月28日)
	 * @param unknown $open_id
	 */
	public function findUserByField($field, $value) 
	{
	    return self::$users::where($field, '=', $value)->first();
	}
}
