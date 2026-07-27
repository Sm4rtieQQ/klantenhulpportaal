<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::inRandomOrder()->first(),
            'created_by' => User::where('admin', true)->inRandomOrder()->first(),
            'body' => fake()->paragraph(),
            'created_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
