<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserAccess
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
        if(auth()->user() && 
            (
               strtolower(auth()->user()->role->role) == 'staff' 
            || strtolower(auth()->user()->role->role) == 'qa manager' 
            || strtolower(auth()->user()->role->role) == 'qa coordinator'
            )
        )
        {
            return $next($request);
        }

        Alert::toast('Admin cannot access the user specific urls', 'error');
        return redirect()->route('home');
    }
}
