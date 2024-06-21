<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_DEBUG') === 'false') {
            Log::info('Request Data:', ['ip' => $request->ip(), 'data' => $request->all()]);
        }

        $response = $next($request);

        if (env('APP_DEBUG') === 'true') {
            Log::info('Response Data:', ['data' => $response->getContent()]);
        }

        return $response;
    }
}
