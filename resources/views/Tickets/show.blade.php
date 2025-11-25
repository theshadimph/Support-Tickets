<x-layout>
    <x-slot:heading>
        Ticket #{{ $ticket->id }}: {{ $ticket->title }}
    </x-slot:heading>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">

            {{-- COLUMN 1: Ticket Details and Comments --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Ticket Details Card --}}
                <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">Issue Description</h2>

                    <div class="flex justify-between items-start mb-4">
                        <div class="text-sm font-medium text-gray-500">
                            Submitted by: <span class="text-gray-900">{{ $ticket->client->first_name }} {{ $ticket->client->last_name }}</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            Created: {{ $ticket->created_at->format('M j, Y H:i') }}
                        </div>
                    </div>

                    <p class="text-gray-700 whitespace-pre-wrap">{{ $ticket->text }}</p>

                    @php
                        // Safely decode photos, assuming it's a JSON string or an array
                        $photos = is_string($ticket->photos) ? json_decode($ticket->photos, true) : ($ticket->photos ?? []);
                    @endphp

                    @if (!empty($photos) && is_array($photos))
                        <div class="mt-6 border-t pt-4">
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Attachments ({{ count($photos) }})</h3>
                            <div class="flex flex-wrap gap-4">
                                @foreach ($photos as $url)
                                    <a href="{{ $url }}" target="_blank" class="block w-24 h-24 overflow-hidden rounded-lg border-2 border-gray-300 hover:border-indigo-500 transition duration-150">
                                        {{-- Fallback image for safety --}}
                                        <img src="{{ $url }}" alt="Attachment" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='https://placehold.co/96x96/f3f4f6/374151?text=File';">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Comments History --}}
                <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">Communication History ({{ $ticket->comments->count() }})</h2>

                    <div class="space-y-6 max-h-96 overflow-y-auto pr-2">
                        @forelse ($ticket->comments->sortBy('created_at') as $comment)
                            @php
                                $isClient = $comment->user->role === 'client';
                                $bgClass = $isClient ? 'bg-green-50' : 'bg-indigo-50';
                                $borderClass = $isClient ? 'border-green-300' : 'border-indigo-300';
                            @endphp
                            <div class="p-4 rounded-lg border-l-4 {{ $bgClass }} {{ $borderClass }}">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm font-semibold text-gray-900">
                                        {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                        <span class="text-xs font-normal {{ $isClient ? 'text-green-600' : 'text-indigo-600' }}">({{ ucfirst($comment->user->role) }})</span>
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 whitespace-pre-wrap text-sm">{{ $comment->body }}</p>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 italic">No comments yet. Start the conversation below.</p>
                        @endforelse
                    </div>

                    {{-- Comment Form --}}
                    <div class="mt-6 border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Post a Reply</h3>
                        <form method="POST" action="/tickets/{{ $ticket->id }}/comments">
                            @csrf
                            <x-form-textarea name="body" label="Your Reply" placeholder="Type your message here..." required />
                            <x-form-button type="submit" class="mt-4">Post Comment</x-form-button>
                        </form>
                    </div>
                </div>

            </div>


            {{-- COLUMN 2: Actions Panel (Status, Assignment) --}}
            <div class="lg:col-span-1 mt-8 lg:mt-0 space-y-6">

                {{-- Status and Assigned Employees Card --}}
                <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-3 mb-4">Ticket Overview</h2>

                    {{-- Status Display --}}
                    <div class="mb-4">
                        <span class="text-sm font-medium text-gray-500">Current Status:</span>
                        @php
                            $color = match($ticket->status) {
                                'pending' => 'bg-red-100 text-red-800',
                                'in progress' => 'bg-yellow-100 text-yellow-800',
                                'complete' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-gray-100 text-gray-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <p class="mt-1">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $color }}">
                                {{ ucwords($ticket->status) }}
                            </span>
                        </p>
                    </div>

                    {{-- Assigned Employees Display --}}
                    <div class="mb-4">
                        <span class="text-sm font-medium text-gray-500">Assigned Team:</span>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @forelse ($ticket->employees as $employee)
                                <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-800">
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </span>
                            @empty
                                <span class="text-sm italic text-gray-400">Not yet assigned.</span>
                            @endforelse
                        </div>
                    </div>

                    {{-- Status Change Form (Manager/Employee) --}}
                    @if (auth()->user()->role !== 'client')
                        <div class="mt-4 border-t pt-4">
                            <h3 class="text-sm font-semibold text-gray-600 mb-2">Change Status</h3>
                            <form method="POST" action="/tickets/{{ $ticket->id }}/status">
                                @csrf
                                @method('PATCH')
                                <x-form-select name="status" :options="['pending' => 'Pending', 'in progress' => 'In Progress', 'complete' => 'Complete', 'cancelled' => 'Cancelled']" :selected="$ticket->status" />
                                <x-form-button type="submit" class="mt-3 bg-gray-600 hover:bg-gray-700">Update Status</x-form-button>
                            </form>
                        </div>
                    @endif
                </div>


                {{-- Assignment Panel (Manager Only) --}}
                @if (auth()->user()->role === 'manager')
                    <div class="bg-white shadow-xl rounded-xl p-6 border border-indigo-300">
                        <h2 class="text-xl font-semibold text-indigo-800 border-b pb-3 mb-4">Assignment / Re-assignment</h2>

                        {{-- NOTE: $employees is passed from the TicketController@show method --}}
                        <form method="POST" action="/tickets/{{ $ticket->id }}/assign">
                            @csrf
                            @method('PATCH')

                            <label for="employees" class="block text-sm font-medium text-gray-700 mb-2">Select Team Members (Hold Ctrl/Cmd to select multiple)</label>

                            {{-- The multiple select box for assigning employees --}}
                            <select name="employees[]" id="employees" multiple class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm h-40">
                                @foreach ($employees as $employee)
                                    @php
                                        // Check if the current employee is already assigned to the ticket
                                        $isSelected = $ticket->employees->contains('id', $employee->id);
                                        $displayName = $employee->first_name . ' ' . $employee->last_name . ' (' . ucfirst($employee->role) . ')';
                                    @endphp
                                    <option value="{{ $employee->id }}" @selected($isSelected)>
                                        {{ $displayName }}
                                    </option>
                                @endforeach
                            </select>

                            @error('employees')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror

                            <x-form-button type="submit" class="mt-4 bg-indigo-600 hover:bg-indigo-700">
                                {{ $ticket->employees->isEmpty() ? 'Assign Ticket' : 'Reassign Ticket' }}
                            </x-form-button>
                        </form>
                    </div>
                @endif

                {{-- Delete Ticket (Manager Only - Uses the Policy) --}}
                {{-- Ensure the delete button is visible only if the user is authorized --}}
                @can('delete', $ticket)
                    <div class="mt-6 border-t pt-6">
                        <form method="POST" action="/tickets/{{ $ticket->id }}" class="text-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to permanently delete this ticket and all its history?')"
                                class="text-sm font-medium text-red-600 hover:text-red-800 transition duration-150">
                                Delete Ticket
                            </button>
                        </form>
                    </div>
                @endcan

            </div>
        </div>
    </div>
</x-layout>
