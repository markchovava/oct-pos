<?php

namespace App\Http\Middleware\Moderator;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeratorMiddleware
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
        // return $next($request);
        if( Auth::check() ){
            if( Auth::user()->role_id <= 2 ){
                return $next($request);
            }else{
                return redirect()->route('admin.dashboard');
            }
        }else{
            return redirect()->route('login');
        }
    }
}
