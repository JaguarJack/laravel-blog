<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($this->check($request))->check()) {
            return redirect($this->check($request) ? url()->previous() : 'admin/index');
        }

        return $next($request);
    }
    
    /**
     * @description:检查请求来源
     * @author wuyanwen(2017年9月18日)
     * @param unknown $request
     * @return string|NULL
     */
    public function check($request) 
    {
        return strpos($request->route()->action['namespace'], 'Home') ? 'home' : null;
    }
}
