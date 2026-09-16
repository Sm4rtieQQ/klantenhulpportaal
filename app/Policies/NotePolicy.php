<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    public function edit(User $user, Note $note)
    {
        return $note->created_by_id === $user->id;
    }
}
