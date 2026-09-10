<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function edit(User $user, Comment $comment)
    {
        return $comment->created_by_id === $user->id || $user->admin;
    }
}
