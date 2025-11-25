<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => User::factory()->state('client'),

            'title' => $this->faker->sentence(4),
            'photos' => json_encode([]),
            'text' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'in progress', 'complete']),
        ];
    }

    /**
     * Indicate that the ticket status is 'pending'.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the ticket status is 'in progress'.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in progress',
        ]);
    }

    /**
     * Indicate that the ticket status is 'complete'.
     */
    public function complete(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'complete',
        ]);
    }
}