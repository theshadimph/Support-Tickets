<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @param array $parameters Parameters passed from DatabaseSeeder
     */
    public function run(array $parameters = []): void
    {
        $client = $parameters['client'] ?? User::where('role', 'client')->first();
        $employee = $parameters['employee'] ?? User::where('role', 'employee')->first();
        $manager = $parameters['manager'] ?? User::where('role', 'manager')->first();

        if (!$client || !$employee || !$manager) {
            echo "Missing required test users. Run DatabaseSeeder first.\n";
            return;
        }

        $tickets = Ticket::factory(6)
            ->create(['client_id' => $client->id]);

        $tickets->each(function (Ticket $ticket) use ($employee, $manager) {


            $ticket->employees()->attach($employee->id);

            if (fake()->boolean(70)) {
                $ticket->status = fake()->randomElement(['in progress', 'complete']);
                $ticket->save();
            }

            $numComments = fake()->numberBetween(1, 3);
            for ($i = 0; $i < $numComments; $i++) {
                $userCommenting = fake()->randomElement([$employee, $manager]);
                $ticket->comments()->create([
                    'user_id' => $userCommenting->id,
                    'body' => ($i == 0 ? "Initial assessment: " : "Update: ") . fake()->sentence(8)
                ]);
            }
        });
    }
}