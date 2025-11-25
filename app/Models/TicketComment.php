<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'ticket_comments';

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_listing_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}