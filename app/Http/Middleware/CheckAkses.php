<?php

namespace App\Http\Middleware;

use Closure;

class CheckAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (thisRole() != 'admin-master') {
            $haveAkses = haveAkses();
            if ($haveAkses == false) {
                return redirect()->route('403.no-have-akses');
            }

            $haveRole = thisRole();
            if ($haveRole == null) {
                return redirect()->route('403.no-have-role');
            }
        }

        return $next($request);
    }
}
