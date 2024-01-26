<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class Privilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $privilege)
    {
        if (Auth::check()) {
            if(Auth::user()->hasPrivilege($privilege))
            {
                return $next($request);
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect('/login');
        }

    }
}
