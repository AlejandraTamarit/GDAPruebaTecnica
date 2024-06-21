<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AuthToken;

class AuthenticateToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            
            return response()->json(['success' => false, 'message' => 'No se proporcionado ningún token'], 401);
        }

        $authToken = AuthToken::where('token', $token)->first();

        if (!$authToken || $authToken->isExpired()) {

            return response()->json(['success' => false, 'message' => 'Token no válido o expirado'], 401);
        }

        return $next($request);
    }
}
