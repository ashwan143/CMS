<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->role) {
            abort(403, 'No role assigned to this user.');
        }

        if (!auth()->user()->role->status) {
            abort(403, 'Your role is inactive.');
        }

        return $next($request);
    }
}
