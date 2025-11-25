<x-layout>
    <x-slot:heading>
        Support Team Directory
    </x-slot:heading>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        {{-- Loop through the team members (Managers and Employees) --}}
        @forelse ($team_members as $member)
            <div class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-xl bg-white text-center shadow-xl transition duration-200 hover:shadow-2xl">
                <div class="flex flex-1 flex-col p-8">
                    {{-- Placeholder for avatar/initials --}}
                    <span class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-indigo-100 text-2xl font-semibold text-indigo-700">
                        {{ $member->first_name[0] }}{{ $member->last_name[0] }}
                    </span>

                    <h3 class="mt-6 text-lg font-medium text-gray-900">{{ $member->first_name }} {{ $member->last_name }}</h3>

                    {{-- Role Badge --}}
                    <dl class="mt-1 flex grow flex-col justify-between">
                        <dt class="sr-only">Role</dt>
                        @php
                            $color = $member->role === 'manager' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800';
                        @endphp
                        <dd class="mt-3">
                            <span class="inline-flex items-center rounded-full px-3 py-0.5 text-sm font-medium {{ $color }}">
                                {{ ucwords($member->role) }}
                            </span>
                        </dd>

                        {{-- Joined Date --}}
                        <dt class="sr-only">Joined</dt>
                        <dd class="text-sm text-gray-500 mt-2">
                            Joined {{ $member->created_at->format('M j, Y') }}
                        </dd>
                    </dl>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                <p class="text-lg font-medium">No active support team members found.</p>
                <p class="text-sm mt-1">Please check the database configuration or user roles.</p>
            </div>
        @endforelse
    </div>
</x-layout>
