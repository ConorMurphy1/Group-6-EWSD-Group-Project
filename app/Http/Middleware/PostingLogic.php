<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PostingLogic
{
    /** For handling idea creation only for ADMIN and STAFF */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if($user && strtolower($user->role->role) == 'admin')
        {
            return $next($request);
        }
        if($user && strtolower($user->role->role) == 'staff')
        {
            return $next($request);
        }

        Alert::toast($user->role->role . ' cannot upload ideas', 'error');
        return redirect()->route('ideas.feed');
    }
}
