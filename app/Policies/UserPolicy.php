<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function deleteTarget(User $authUser, User $targetUser): bool
    {
        return $targetUser->id !== $authUser->id;
    }

    public function hasActiveTickets(User $targetUser): bool
    {
        return !$targetUser->createdTickets()
            ->whereIn('status', [1, 2, 3])
            ->exists();
    }

    public function hasAssignedTickets(User $targetUser): bool
    {
        return !($targetUser->admin && $targetUser->assignedTickets()->exists());
    }
}
