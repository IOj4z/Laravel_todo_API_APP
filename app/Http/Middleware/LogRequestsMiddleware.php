<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequestsMiddleware
{
    public function handle($request, Closure $next)
    {

        Log::channel('request')->info('Request:', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'parameters' => $request->all(),
            'headers' => $request->header(),
        ]);
        return $next($request);
    }
}
