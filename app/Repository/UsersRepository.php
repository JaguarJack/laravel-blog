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
            	    ->select('user_name', 'email', 'avatar', 'come_from', 'type','sex', 'activation', 'status')
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
	        'email' => $data['email'],
	        'password' => bcrypt($data['password']),
	    ]);
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
	    return self::$users::where('id', '=', $id)->find($id)->hasManyUserArticles;
	}
}
