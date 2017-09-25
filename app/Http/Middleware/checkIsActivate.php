<?php

namespace App\Http\Middleware;

use Closure;
 
class checkIsActivate
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
        $user = $request->user('home');
        
        //如果是未激活状态
        if ( $user->activation == 1 ) {
            
            return $request->ajax() ? response()->json([
                'code' => 10001,
                'msg'  => '目前使用的邮箱未激活, 请先激活后使用',
            ])  : abort(404, '目前使用的邮箱未激活, 请先激活后使用');
        }
        
        return $next($request);
    }
}
