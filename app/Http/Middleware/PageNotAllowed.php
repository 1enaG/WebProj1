<?php

namespace App\Http\Middleware;

use Closure;

class PageNotAllowed
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
        return response('<h1>Page is not available</h1>');
    }
}
