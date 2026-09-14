<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return UserResource::collection($users);
    }

    public function getAdmins()
    {
        $admins = User::where('admin', true)->get();
        return UserResource::collection($admins);
    }

    public function update(UserRequest $request, int $userId)
    {
        $user = User::find($userId);

        $newData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'role' => $request->role,
            'tel' => $request->tel,
            'admin' => $request->admin,
        ];

        $user->update($newData);
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        $userName = $user->name . ' ' . $user->surname;

        $user->delete();
        return response()->json([
            'message' => $userName . ' verwijderd.'
        ]);
    }
}
