<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $admin_name=$request->session()->get("admin_name");
        if(!$admin_name){
            return redirect("/login");
        }
        return $next($request);
    }
}
