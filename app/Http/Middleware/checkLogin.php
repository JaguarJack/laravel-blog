<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('home')->check()) {
            
            $msg = ['code' => 10001, 'msg' => '未登录'];
            
            return $request->ajax() ? response()->json($msg) : redirect(url()->previous());     
        }
        
        return $next($request);
    }
}
   