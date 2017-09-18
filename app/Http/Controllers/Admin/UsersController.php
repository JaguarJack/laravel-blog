<?php

namespace App\Http\Controllers\Admin;

use App\Service\UsersService;

class UsersController extends BaseController
{
    //
    
    public function index(UsersService $service)
    {
        return view('admin.users.index',[
            'type' => $service->type,
        ]);
    }
}
