<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        Ticket::factory(20)->create()->each(function ($ticket) use ($categories) {
            $ticket->categories()->attach($categories->random(rand(1, 4))->pluck('id'));
        });
    }
}
