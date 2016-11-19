<?php

namespace gexo\Http\Middleware;

use Closure;
use Auth;

class UserVerify
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
        if (Auth::guest()) {
            return redirect('/');
        }
        return $next($request);
    }
}
