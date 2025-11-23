<?php

namespace App\Http\Middleware\Universal;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // jika user belum login → redirect ke login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // ambil user
        $user = auth()->user();

        // jika role tidak sesuai → forbidden 403
        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
