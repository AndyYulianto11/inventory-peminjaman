<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {
            $user = Auth::user()->role;
            if($user== $role) {
                return $next($request);
            }
        }

        if (Auth::user()->role == 'pengaju') {
            return redirect('/pengaju');
        } else if(Auth::user()->role == 'atasan') {
            return redirect('/atasan');
        } else if(Auth::user()->role == 'keuangan') {
            return redirect('/keuangan');
        } else if(Auth::user()->role == 'rektor') {
            return redirect('/rektor');
        } else {
            return redirect('/');
        }

    }
}
