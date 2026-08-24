<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function user()
    {
        $userData = UserResource::make(Auth::user());
        return response()->json($userData);
    }

    public function authenticate(AuthRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'user' => Auth::user(),
            ]);
        }

        return response()->json([
            'message' => 'Ongeldige inloggegevens',
        ], 401);
    }

    public function invalidate(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
