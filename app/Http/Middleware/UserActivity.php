<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class UserActivity
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
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(2); /* sudah diberi waktu disini kita sudah set 2 menit. */
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
  
            /* pengguna terakhir terlihat */
            User::where('id', Auth::user()->id)->update(['last_seen' => now()]);
        }

        return $next($request);
    }
}
