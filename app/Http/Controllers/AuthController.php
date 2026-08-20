<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
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
    }
}
