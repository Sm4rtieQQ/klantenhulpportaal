<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function status()
    {
        return response()->json([
            'isLoggedIn' => Auth::guard('sanctum')->check(),
        ]);
    }

    public function user()
    {
        $userData = UserResource::make(Auth::user());
        return response()->json($userData);
    }

    public function login(AuthRequest $request)
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

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }


    public function register(AuthRequest $request)
    {
        $user = User::create([
            'name'      => $request->name,
            'surname'   => $request->surname,
            'role'      => $request->role,
            'tel'       => $request->tel,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'admin'     => false,
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => 'Nieuwe gebruiker aangemaakt',
            'user' => $user,
        ]);
    }
}
