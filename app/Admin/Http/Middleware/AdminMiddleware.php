<?php

namespace App\Admin\Http\Middleware;

class AdminMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (!\Auth::guest() && \Auth::user()->isAdmin())
        {
            return $next($request);
        }
        return redirect()->route('admin.login.form');
    }
}
