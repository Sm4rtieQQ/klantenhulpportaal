<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
                'user' => UserResource::make(Auth::user()),
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

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Nieuwe gebruiker aangemaakt',
            'user' => $user,
        ]);
    }


    // verification
    public function verifyEmail(EmailVerificationRequest $request)
    {
        if (!$request->user()->email_verified_at) {
            $request->fulfill();
            Mail::send(new EmailVerification($request->user()));
        };

        return redirect('/tickets');
    }

    public function resendEmailNotice(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            'message' => 'Email verzonden!'
        ]);
    }

    // password reset
    public function receivePasswordResetToken(Request $request, string $token)
    {
        $email = $request->query('email');

        $user = User::where('email', $email)->first();

        return redirect()->to(
            '/email/new-password/' . urlencode($token) . '?email=' . urlencode($email)
        );
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Er bestaat geen account met dit e-mailadres.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::ResetLinkSent) {
            return response()->json([
                'message' => 'De resetlink is verstuurd.',
            ]);
        }

        return response()->json([
            'message' => 'De resetlink kon niet worden verstuurd.',
            'errors' => ['email' => [__($status)]],
        ], 422);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? response()->json([
                'message' => 'Nieuw wachtwoord opgeslagen.'
            ])
            : response()->json([
                'message' => 'Er ging iets mis',
                'errors' => ['email' => [__($status)]],
            ]);
    }
}
