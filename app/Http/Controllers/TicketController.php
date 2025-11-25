<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\TicketComment;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $this->authorize('viewAny', Ticket::class);

        $ticketsQuery = Ticket::with(['client', 'employees', 'comments']);

        if ($user->role === 'client') {
            $ticketsQuery->where('client_id', $user->id);
        } elseif ($user->role === 'employee') {
            $ticketsQuery->whereHas('employees', function ($query) use ($user) {
                $query->where('employee_id', $user->id);
            });
        }

        $tickets = $ticketsQuery->latest()->paginate(10);

        return view('tickets.index', [
            'tickets' => $tickets
        ]);
    }

    public function create() {
        $this->authorize('create', Ticket::class);
        return view('tickets.create');
    }

    public function show(Ticket $ticket)
    {
        $employees = User::whereIn('role', ['employee', 'manager'])->get();

        return view('tickets.show', [
            'ticket' => $ticket,
            'employees' => $employees,
        ]);
    }
    public function store(Request $request) {
        $this->authorize('create', Ticket::class);

        $attributes = $request->validate([
            'title' => ['required','string','min:3','max:255'],
            'text' => ['required','string'],
            'photos' => ['nullable', 'array', 'max:5'],
            'photos.*' => ['image', 'max:2048'],
        ]);

        $photoPaths = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('screenshots', 'public');
                $photoPaths[] = $path;
            }
        }

        Ticket::create([
            'client_id' => Auth::id(),
            'title' => $attributes['title'],
            'text' => $attributes['text'],
            'status' => 'pending',
            'photos' => json_encode($photoPaths),
        ]);

        return redirect('/tickets')->with('success', 'Ticket created successfully!');
    }

    public function edit(Ticket $ticket) {
        $this->authorize('update', $ticket);
        return view('tickets.edit', ['ticket' => $ticket]);
    }

    public function update(Request $request, Ticket $ticket) {
        $this->authorize('update', $ticket);

        $request->validate([
            'title' => ['required','string','min:3','max:255'],
            'text' => ['required','string'],
        ]);

        $ticket->update($request->only('title', 'text'));

        return redirect($ticket->path())->with('success', 'Ticket updated successfully!');
    }

    public function destroy(Ticket $ticket) {
        $this->authorize('delete', $ticket);
        $ticket->delete();

        return redirect('/tickets')->with('success', 'Ticket deleted.');
    }

    /**
     * Update the status of a specific ticket.
     * Authorized: Manager, or Assigned Employee.
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $this->authorize('changeStatus', $ticket);

        $validated = $request->validate([
            'status' => ['required', 'string',
                Rule::in(['pending', 'in progress', 'complete', 'cancelled'])
            ],
        ]);

        $ticket->update(['status' => $validated['status']]);

        return redirect($ticket->path())->with('success', 'Ticket status updated to ' . $validated['status'] . '.');
    }

    /**
     * Assigns one or more employees to a ticket.
     * Authorized: Manager only.
     */
    public function assignEmployees(Request $request, Ticket $ticket)
    {
        $this->authorize('assignEmployee', $ticket);

        $validated = $request->validate([
            'employee_ids' => ['nullable', 'array'],
            'employee_ids.*' => [
                'integer',
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->where('role', 'employee');
                }),
            ],
        ]);

        $ticket->employees()->sync($validated['employee_ids'] ?? []);

        return back()->with('success', 'Ticket assignment updated successfully.');
    }

    /**
     * Stores a new comment for the given ticket.
     * Authorized: Manager or Assigned Employee (Client explicitly denied via Policy).
     */
    public function storeComment(Request $request, Ticket $ticket)
    {
        $this->authorize('comment', $ticket);

        $validated = $request->validate([
            'body' => ['required', 'string', 'min:5', 'max:1000'],
        ]);

        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
