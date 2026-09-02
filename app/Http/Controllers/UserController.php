<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function getAdmins()
    {
        $admins = User::where('admin', true)->get();
        return UserResource::collection($admins);
    }
}
