<?php

namespace App\Http\Middleware;

use App\Traits\HasApiResponsesTrait;
use Closure;
use Illuminate\Http\Request;

class CheckCustomer
{
    use HasApiResponsesTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(getCurrentGuard() == 'api')
        {
        return $next($request);
        }
        return $this->respondWithError('You are not customer.');


    }
}
