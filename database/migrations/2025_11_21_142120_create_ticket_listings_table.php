<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'client_id')->constrained('users')->cascadeOnDelete(); // <-- Ticket Creator (must be a 'client' role)
            $table->string('title');
            $table->json('photos')->nullable();
            $table->text('text');
            $table->enum('status', ['pending', 'in progress', 'complete'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_listings');
    }
};
