<?php

namespace App\Http\Middleware;

use App\Traits\HasApiResponsesTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticate
{
    use HasApiResponsesTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next (\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param null $guard
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->guest()) {
            if ($guard == 'api') {
                return $this->respondWithError('User not logged in.');
            }
        }
        return $next($request);
    }
}
