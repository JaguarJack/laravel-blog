<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Repository\UsersRepository;

class FileController extends Controller
{
    //
    /**
     * @description:上传头像
     * @author wuyanwen(2017年9月20日)
     * @param Request $request
     */
    public function uploadAvatar(Request $request, UsersRepository $user)
    {
        if ($request->hasFile('file')) {
            $user = $request->user('home');
            $image = Config::get('home.image');
            
            if (!in_array($request->file('file')->extension(), $image['type'])) {
                $this->ajaxError('头像类型不符合, 只允许' . implode(',', $image['type']));
            }
            
            $path = $request->file('file')->store('avatar');
            
            $avatar = Config::get('filesystems.disks.images.path') . '/' . $path;
            
            if (!$user->update(['id' => $user->id, 'avatar' => $avatar])) {
                return $this->ajaxError('上传失败');
            }
           
            $user->avatar = $avatar;
            return $this->ajaxSuccess('上传成功');
        } else {
            return $this->ajaxError('请选择上传的头像');
        }
    }
}
