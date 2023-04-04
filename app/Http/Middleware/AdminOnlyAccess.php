<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminOnlyAccess
{
    /** Only ADMIN  */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if($user && strtolower($user->role->role) == 'admin')
        {
            return $next($request);
        }

        Alert::toast('Trying to access the invalid url', 'error');
        return redirect()->route('dashboard');
    }
}
