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
        if ($request->is('api/*')) {
            $errors[] = ['code' => 'auth-001', 'message' => 'Unauthorized.'];
            abort(response()->json([
                'errors' => $errors
            ], 401));
        } else if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
