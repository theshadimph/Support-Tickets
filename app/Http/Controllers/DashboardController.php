<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a dashboard view tailored to the authenticated user's role.
     */
    public function index()
    {
        $user = Auth::user();
        $data = [];

        // Check user role using the direct 'role' column value
        if ($user->role === 'manager') {
            // Manager: Overall counts
            $data['total'] = Ticket::count();
            $data['pending'] = Ticket::where('status', 'pending')->count();
            $data['in_progress'] = Ticket::where('status', 'in progress')->count();
            $data['complete'] = Ticket::where('status', 'complete')->count();

        } elseif ($user->role === 'employee') {
            // Employee: Assigned ticket counts
            // Note: We use the relationship defined on the User model (assuming assignedTickets())
            $data['assigned'] = $user->assignedTickets()->count();
            $data['in_progress'] = $user->assignedTickets()->where('status', 'in progress')->count();
            $data['pending'] = $user->assignedTickets()->where('status', 'pending')->count();

        } else { // Client (role must be 'client')
            // Client: Their ticket counts
            // Note: We use the relationship defined on the User model (assuming createdTickets())
            $data['total'] = $user->createdTickets()->count();
            $data['pending'] = $user->createdTickets()->where('status', 'pending')->count();
            $data['in_progress'] = $user->createdTickets()->where('status', 'in progress')->count();
            $data['complete'] = $user->createdTickets()->where('status', 'complete')->count();
        }

        return view('dashboard', ['data' => $data]);
    }
}