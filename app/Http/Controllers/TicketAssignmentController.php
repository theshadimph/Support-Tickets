<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
// NOTE: We do not need the custom authorize method.
// The parent Controller's $this->authorize('assign', $ticket) automatically
// calls the assign method in the TicketPolicy, which is the standard, secure way.

class TicketAssignmentController extends Controller
{
    /**
     * Assigns one or more employees to a ticket (used for initial assignment and re-assignment).
     */
    public function update(Request $request, Ticket $ticket)
    {
        // 1. Authorization check: This uses the 'assign' method in the registered TicketPolicy.
        // This line is now clean and relies on Laravel's built-in Policy system for security.
        $this->authorize('assign', $ticket);

        // 2. Validation
        $validated = $request->validate([
            // employees is expected to be an array of user IDs
            'employees' => ['required', 'array'],
            'employees.*' => ['exists:users,id'], // Ensure all provided IDs exist in the users table
        ]);

        // 3. Attach/Sync employees
        // The sync method handles both assignment and re-assignment:
        // It detaches any employees not in the new array and attaches the ones that are new.
        $ticket->employees()->sync($validated['employees']);

        // 4. Update status if it was pending and is now assigned
        if ($ticket->status === 'pending') {
            $ticket->update(['status' => 'in progress']);
        }

        // 5. Redirect back to the ticket show page with a success message
        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket assigned successfully. The assigned employees have been notified.');
    }
}
