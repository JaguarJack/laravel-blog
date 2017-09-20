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
     * @description:上传图片
     * @author wuyanwen(2017年9月20日)
     * @param Request $request
     */
    public function uploadImage(Request $request, UsersRepository $user)
    {
        if ($request->hasFile('file')) {
            $user_id = $request->user('home')->id;
            $image = Config::get('home.image');
            
            if (!in_array($request->file('file')->extension(), $image['type'])) {
                $this->ajaxError('图片类型不符合, 只允许' . implode(',', $image['type']));
            }
            $path = $request->file('file')->store('avatar');

            return $user->update(['id' => $user_id, 'avatar' => Config::get('filesystems.disks.images.path') . '/' . $path]) ? 
            
                        $this->ajaxSuccess('上传成功') : $this->ajaxError('上传失败');
        } else {
            return $this->ajaxError('请选择上传的头像');
        }
    }
}
