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
                $rand <= 5 => 1,    // 'new'
                $rand <= 50 => 2,   // 'pending'
                $rand <= 85 => 3,   // 'in_progress'
                $rand <= 95 => 4,   // 'completed'
                default => 5,       // 'abandoned'
            };
        };

        $createdAt = fake()->dateTimeBetween('-1 month');
        $updatedAt = fake()->dateTimeBetween($createdAt);

        return [
            'title' => fake()->sentence(3),
            'body' => fake()->paragraph(),
            'status' => $status,
            'created_by_id' => $createdBy,
            'assigned_to_id' => $assignedTo,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
