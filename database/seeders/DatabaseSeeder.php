<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    // Keeping this trait if you had it, but removing it won't hurt
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $manager = User::factory()->manager()->create([
            'first_name' => 'Manager',
            'last_name' => 'Admin',
            'email' => 'manager@app.com',
            'password' => Hash::make('password'),
        ]);

        $employee = User::factory()->employee()->create([
            'first_name' => 'Employee',
            'last_name' => 'Support',
            'email' => 'employee@app.com',
            'password' => Hash::make('password'),
        ]);

        $client = User::factory()->client()->create([
            'first_name' => 'Client',
            'last_name' => 'User',
            'email' => 'client@app.com',
            'password' => Hash::make('password'),
        ]);

        $this->callWith(TicketSeeder::class, [
            'client' => $client,
            'employee' => $employee,
            'manager' => $manager,
        ]);

        User::factory(5)->create();
    }
}
