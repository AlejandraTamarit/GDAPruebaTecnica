<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AuthToken;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json(['success' => false, 'message' => 'Acceso Incorrecto!'], 401);
            
        }

        $randomNumber = rand(200, 500);
        $tokenString = $request->email . now() . $randomNumber;
        $token = sha1($tokenString);

        $expiresAt = Carbon::now()->addHours(1);

        $authToken = AuthToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        return response()->json(['success' => true, 'token' => $token, 'expires_at' => $expiresAt], 200);
    }
}
