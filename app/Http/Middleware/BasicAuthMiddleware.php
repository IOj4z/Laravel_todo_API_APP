<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasicAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $credentials = $request->header('Authorization');

        if (!$credentials || strpos($credentials, 'Basic ') !== 0) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $base64Credentials = substr($credentials, 6);
        list($email, $password) = explode(':', base64_decode($base64Credentials));

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
