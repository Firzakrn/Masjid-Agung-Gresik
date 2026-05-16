<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Jika yang diakses adalah area admin, lempar ke login admin
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }
            
            // Selain itu lempar ke login biasa
            return route('login');
        }
        
        return null;
    }
}
