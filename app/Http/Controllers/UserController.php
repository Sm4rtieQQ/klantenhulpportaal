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

    public function update(UserRequest $request, User $user)
    {
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
        $userName = $user->name . ' ' . $user->surname;

        if (Gate::denies('deleteTarget', $user)) {
            abort(409, 'U kunt uzelf niet verwijderen, vraag een andere administrator om dit voor u te doen.');
        }

        if (Gate::forUser($user)->denies('hasActiveTickets', User::class)) {
            abort(409, $userName . ' heeft niet afgehandelde tickets en kan daarom niet worden verwijderd.');
        }

        if (Gate::forUser($user)->denies('hasAssignedTickets', User::class)) {
            abort(409, $userName . ' heeft toegewezen tickets en kan daarom niet worden verwijderd.');
        }

        $user->delete();
        return response()->json([
            'message' => $userName . ' verwijderd.'
        ]);
    }
}
