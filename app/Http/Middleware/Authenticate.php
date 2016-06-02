<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{

    //apstrādā ienākošo pieprasījumu
    public function handle($request, Closure $next, $role = null)
    {
        if (Auth::guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('/');
            }
        }

        if ($role) {
            if ($request->user()->cannot($role)) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
