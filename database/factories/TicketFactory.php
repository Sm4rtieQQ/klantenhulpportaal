<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdBy = User::inRandomOrder()
            ->first();
        $assignedTo = User::whereNotIn('id', [$createdBy])
            ->where('admin', true)
            ->inRandomOrder()
            ->first();

        $status = function () {
            $rand = fake()->numberBetween(1, 100);

            return match (true) {
                $rand <= 50 => 'pending',
                $rand <= 85 => 'in_progress',
                $rand <= 95 => 'completed',
                default => 'abandoned',
            };
        };

        return [
            'title' => fake()->sentence(3),
            'body' => fake()->paragraph(),
            'status' => $status,
            'created_by' => $createdBy,
            'assigned_to' => $assignedTo,
        ];
    }
}
