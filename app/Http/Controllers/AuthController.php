<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();

            return response()->json([
                'user' => $user,
            ]);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            response()->json(['message' => 'Er ging iets mis'], 403);
        }
        $request->user()->tokens()->delete();
        $request->session()->invalidate();

        return response()->json(['message' => 'Succesvol uitgelogd']);
    }
}
