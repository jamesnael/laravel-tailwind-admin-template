<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $access)
    {
        if (in_array($access, ($request->user()->jabatan->hak_akses?: []))) {
            return $next($request);
        }
        abort(403);
    }
}
