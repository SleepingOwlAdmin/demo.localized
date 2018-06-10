<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompanyVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $guard = 'company';

        if (Auth::guard($guard)->check()) {
            if (!Auth::user()->isVerified()) {
                Auth::logout();

                flash()->warning(trans('portal.companies.message.unverified'));

                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
