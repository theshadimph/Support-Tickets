<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket_listings';
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'photos' => 'array',
        ];
    }

    public function client() {
        // Renamed from client_id to user_id in the migration, but using client() method for clarity
        return $this->belongsTo(User::class, 'client_id');
    }

    public function employees() {
        return $this->belongsToMany(User::class, 'ticket_employee', 'ticket_listing_id', 'employee_id');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class, 'ticket_listing_id')->latest();
    }
}
