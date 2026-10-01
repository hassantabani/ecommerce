<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ScannerMiddleware
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
        $user = auth()->user()->user_type;
        if($user == 'scannner'){
            return $next($request);
        }
       abort(404);
    }
}
