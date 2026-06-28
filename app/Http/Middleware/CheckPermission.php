<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->checkPermission($request);
        return $next($request);
    }


    public function checkPermission(Request $request)
    {
        $user = auth()->user();

        if(! $user->role){
            notify()->warning("You don't have access on this page",'warning');
            return back();
        }else{
            $permissions = $user->role->permissions->pluck('slug')->toArray();
            $current_route_name = $request->route()->action['as'];
            if($current_route_name!='admin.dashboard'){
                if(! in_array($current_route_name, $permissions)){
                    notify()->warning("You don't have access on this page",'warning');
                    return back();
                }
            }

        }
    }
}
