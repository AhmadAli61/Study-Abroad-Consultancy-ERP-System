<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckViewOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->permission_level === 'view_only') {
            // Check if the request is a non-GET request (POST, PUT, PATCH, DELETE)
            if (!$request->isMethod('get')) {
                // For Livewire requests, we'll handle this differently
                if ($request->header('X-Livewire')) {
                    abort(403, 'View-only admins cannot perform this action');
                }
                
                // For regular form submissions, redirect back with error
                return back()->with('error', 'View-only admins cannot perform this action');
            }
        }

        return $next($request);
    }
}