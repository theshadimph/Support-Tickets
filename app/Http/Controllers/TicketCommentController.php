<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketCommentController extends Controller
{
    /**
     * Store a new comment for the given ticket.
     * The policy handles authorization (only client, manager, or assigned employee can comment).
     */
    public function store(Request $request, Ticket $ticket)
    {
        $user = Auth::user();

        $this->authorize('comment', $ticket);

        $validated = $request->validate([
            'body' => ['required', 'string', 'min:5', 'max:1000'],
        ]);

        $ticket->comments()->create([
            'user_id' => $user->id,
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
