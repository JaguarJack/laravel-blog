<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;

class StoreController extends Controller
{
    //
    public function getStoreArticles(Request $request, StoreRepository $store)
    {
        $page = intval($request->input('page'));
        $user_id = intval($request->input('user_id'));
        
        return $this->ajaxSuccess('', $store->getStoreArticles($user_id, 10, $page - 1)->toArray());
    }
}
