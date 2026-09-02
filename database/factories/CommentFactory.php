<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ticket = Ticket::inRandomOrder()->first();
        if (fake()->boolean()) {
            $createdById = User::where('admin', true)->inRandomOrder()->first();
        } else {
            $createdById = $ticket->createdBy;
        }


        return [
            'ticket_id' => $ticket,
            'created_by_id' => $createdById,
            'body' => fake()->paragraph(),
        ];
    }
}
