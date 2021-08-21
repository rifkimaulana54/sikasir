<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckKasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $kasir = $request->user();
        if ($kasir)
            if ($kasir->hasRole('kasir'))
                return $next($request);

        abort(404);
    }
}
