<x-layout>
    <x-slot:heading>
        Dashboard
    </x-slot:heading>

    <div class="space-y-10">
        @auth
            {{-- This greeting is now safely inside the @auth block --}}
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-6">Welcome back, {{ auth()->user()->first_name }}!</h1>

            @if (auth()->user()->isManager())
                <h2 class="text-2xl font-semibold border-b pb-2 mb-4 text-indigo-600">Manager Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    {{-- Uses the newly created x-card component --}}
                    <x-card title="Total Tickets" value="{{ $data['total'] ?? 0 }}" class="bg-blue-100 border-blue-400" />
                    <x-card title="Pending" value="{{ $data['pending'] ?? 0 }}" class="bg-yellow-100 border-yellow-400" />
                    <x-card title="In Progress" value="{{ $data['in_progress'] ?? 0 }}" class="bg-orange-100 border-orange-400" />
                    <x-card title="Complete" value="{{ $data['complete'] ?? 0 }}" class="bg-green-100 border-green-400" />
                </div>
            @elseif (auth()->user()->isEmployee())
                <h2 class="text-2xl font-semibold border-b pb-2 mb-4 text-indigo-600">Employee Assignments</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Uses the newly created x-card component --}}
                    <x-card title="Assigned Tickets" value="{{ $data['assigned'] ?? 0 }}" class="bg-blue-100 border-blue-400" />
                    <x-card title="Pending" value="{{ $data['pending'] ?? 0 }}" class="bg-yellow-100 border-yellow-400" />
                    <x-card title="In Progress" value="{{ $data['in_progress'] ?? 0 }}" class="bg-orange-100 border-orange-400" />
                </div>
            @else {{-- Client --}}
                <h2 class="text-2xl font-semibold border-b pb-2 mb-4 text-indigo-600">Your Tickets</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    {{-- Uses the newly created x-card component --}}
                    <x-card title="Total Tickets" value="{{ $data['total'] ?? 0 }}" class="bg-blue-100 border-blue-400" />
                    <x-card title="Pending" value="{{ $data['pending'] ?? 0 }}" class="bg-yellow-100 border-yellow-400" />
                    <x-card title="In Progress" value="{{ $data['in_progress'] ?? 0 }}" class="bg-orange-100 border-orange-400" />
                    <x-card title="Complete" value="{{ $data['complete'] ?? 0 }}" class="bg-green-100 border-green-400" />
                </div>
                <div class="mt-8">
                    <a href="/tickets/create" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Create New Ticket
                    </a>
                </div>
            @endif
        @else
            {{-- Guest/Unauthenticated Fallback --}}
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-6">Welcome to the Support System!</h1>
            <p class="text-lg text-gray-600">Please <a href="/login" class="text-indigo-600 hover:text-indigo-800 font-semibold">log in</a> to view your dashboard and tickets.</p>
        @endauth
    </div>
</x-layout>
