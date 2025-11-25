<x-layout>
    <x-slot:heading>
        Ticket Listing
    </x-slot:heading>

    <div class="space-y-6">
        {{-- Create Ticket Button (Client Only) --}}
        @can('create', \App\Models\Ticket::class)
            <div class="flex justify-end">
                <a href="/tickets/create"
                    class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-indigo-700 transition duration-150 transform hover:scale-[1.01]">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create New Ticket
                </a>
            </div>
        @endcan

        <div class="bg-white shadow-xl rounded-xl overflow-x-auto border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue Text</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Screenshots</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Employees</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comments</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($tickets as $ticket)
                        <tr class="hover:bg-indigo-50 transition duration-150 cursor-pointer" onclick="window.location='/tickets/{{ $ticket->id }}'">
                            {{-- Title --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="/tickets/{{ $ticket->id }}" class="text-indigo-600 hover:text-indigo-900">{{ $ticket->title }}</a>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $color = match($ticket->status) {
                                        'pending' => 'bg-red-100 text-red-800',
                                        'in progress' => 'bg-yellow-100 text-yellow-800',
                                        'complete' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-gray-100 text-gray-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                    {{ ucwords($ticket->status) }}
                                </span>
                            </td>

                            {{-- Issue Text (Snippet) --}}
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                {{ Str::limit($ticket->text, 50) }}
                            </td>

                            {{-- Screenshots (Count) --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @php
                                    $photos = is_string($ticket->photos) ? json_decode($ticket->photos, true) : ($ticket->photos ?? []);
                                    $photoCount = is_array($photos) ? count($photos) : 0;
                                @endphp
                                @if ($photoCount > 0)
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-0.5 text-xs font-medium text-blue-800">
                                        {{ $photoCount }} File(s)
                                    </span>
                                @else
                                    <span class="text-xs italic text-gray-400">None</span>
                                @endif
                            </td>

                            {{-- Assigned Employees --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($ticket->employees->count() > 0)
                                    <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-0.5 text-xs font-medium text-indigo-800">
                                        {{ $ticket->employees->count() }} Team Member(s)
                                    </span>
                                @else
                                    <span class="text-xs italic text-gray-400">Unassigned</span>
                                @endif
                            </td>

                            {{-- Employee Comments (Count/Latest) --}}
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                @php $comments = $ticket->comments; @endphp
                                @if ($comments->count() > 0)
                                    <p class="font-medium text-gray-700">{{ $comments->count() }} Comments</p>
                                    @php
                                        $latestComment = $comments->sortByDesc('created_at')->first();
                                        $commenterRole = $latestComment->user->role;
                                    @endphp
                                    <p class="text-xs italic truncate mt-1">
                                        <span class="font-semibold text-{{ $commenterRole === 'client' ? 'green' : 'indigo' }}-600">{{ ucfirst($commenterRole) }}:</span>
                                        {{ Str::limit($latestComment->body, 30) }}
                                    </p>
                                @else
                                    <span class="text-xs italic text-gray-400">No History</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                No tickets found matching your criteria.
                                @can('create', \App\Models\Ticket::class)
                                    <div class="mt-4">
                                        <a href="/tickets/create" class="text-indigo-600 hover:text-indigo-700 font-medium">Create your first ticket now.</a>
                                    </div>
                                @endcan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-6">
            {{ $tickets->links() }}
        </div>
    </div>
</x-layout>
