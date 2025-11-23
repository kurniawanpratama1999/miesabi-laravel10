<?php

namespace App\Http\Middleware\Universal;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            if ($user->role === 'admin') {
                return redirect()->route('products.index');
            }

            return redirect()->route('menu.index');
        }
        return $next($request);
    }
}
