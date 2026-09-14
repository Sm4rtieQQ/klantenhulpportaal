<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function delete(User $authUser, User $targetUser)
    {
        $userName = $targetUser->name . ' ' . $targetUser->surname;

        if ($targetUser->createdTickets()->whereIn('status', [1, 2, 3])->exists()) {
            return response()->json([
                'message' => $userName . ' heeft niet-afgehandelde tickets, en kan daarom niet verwijderd worden.'
            ], 409);
        }

        if ($targetUser->admin) {
            if ($targetUser->assignedTickets()->exists()) {
                return response()->json([
                    'message' => $userName . ' is een administrator aan wie tickets zijn toegewezen, en kan daarom niet verwijderd worden.'
                ], 409);
            }
        }

        return $authUser->admin;
    }
}
