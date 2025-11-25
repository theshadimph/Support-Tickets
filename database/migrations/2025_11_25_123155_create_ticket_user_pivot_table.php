<?php

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
        Schema::create('ticket_employee', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_listing_id')->constrained('ticket_listings')->cascadeOnDelete();

            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete();

            $table->unique(['ticket_listing_id', 'employee_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_employee');
    }
};