<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Allow Managers to bypass all checks (The "super-admin" check).
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isManager()) {
            return true;
        }
        return null;
    }

    /**
     * Determine if the user can view any tickets (index page).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the specific ticket.
     * Clients can only view their own tickets. Employees can only view assigned tickets.
     * Managers already bypass this check (see 'before' method).
     */
    public function view(User $user, Ticket $ticket): bool
    {
        if ($user->isClient()) {
            return $ticket->client->is($user);
        }

        if ($user->isEmployee()) {
            return $ticket->employees->contains($user);
        }
        return false;
    }

    /**
     * Determine if the user can create a ticket. (Only Clients)
     */
    public function create(User $user): bool
    {
        return $user->isClient();
    }

    /**
     * Determine if the user can update the ticket. (Client can only update their own if it's 'pending').
     */
    public function update(User $user, Ticket $ticket): bool
    {
        if ($user->isClient()) {
            return $ticket->client->is($user) && $ticket->status === 'pending';
        }
        return false;
    }

    /**
     * Determine if the user can delete the ticket. (Only the creator, and only if pending).
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->isClient() && $ticket->client->is($user) && $ticket->status === 'pending';
    }

    // --- Custom Actions ---

    /**
     * Determine if the user can assign/reassign an employee to a ticket. (Only Managers)
     */
    public function assign(User $user): bool
    {
        return $user->isManager();
    }

    /**
     * Determine if the user can add comments to a ticket. (Employees and Managers)
     */
    public function comment(User $user): bool
    {
        return $user->isEmployee() || $user->isManager();
    }

    /**
     * Determine if the user can change the status of a ticket. (Employees and Managers)
     */
    public function changeStatus(User $user, Ticket $ticket): bool
    {
        return $user->isEmployee() && $ticket->employees->contains($user);
    }
}
