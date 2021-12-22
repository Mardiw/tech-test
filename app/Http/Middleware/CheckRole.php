<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $akses)
    {
        if ($akses == '0' && auth()->user()->akses != '0' ) {
            abort(403);
        }
        if ($akses == '1' && auth()->user()->akses != '1' ) {
            abort(403);
        }
        return $next($request);
    }
}
