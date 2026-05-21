<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to access admin panel.');
        }

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Access Denied — Admin only area.');
        }

        return $next($request);
    }
}