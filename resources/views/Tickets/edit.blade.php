<x-layout>
    <x-slot:heading>
        Edit Ticket: {{ $ticket->title }}
    </x-slot:heading>

    <form action="/tickets/{{ $ticket->id }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PATCH')

        <div class="bg-gray-800 p-6 rounded-xl shadow-lg border space-y-2 border-white/10">

            {{-- Title --}}
            <div>
                <label class="block font-semibold text-white mb-1">Title</label>
                <input
                    type="text"
                    name="title"
                    class="w-full bg-gray-700 text-white p-3 rounded-lg focus:ring-2 focus:ring-indigo-500"
                    placeholder="Enter ticket title"
                    value="{{ $ticket->title }}"
                    required
                >
                @error('title')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Issue Text --}}
            <div>
                <label class="block font-semibold text-white mb-1">Text</label>
                <textarea
                    name="text"
                    rows="3"
                    class="w-full bg-gray-700 text-white p-3 rounded-lg focus:ring-2 focus:ring-indigo-500"
                    placeholder="Say the issue..."
                    required

                >{{ old('text', $ticket->text ?? '') }}</textarea>
                @error('text')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Submit + Cancel --}}

            <div class="flex justify-end gap-4 pt-4">
                <a href="/tickets/{{ $ticket->id }}"
                   class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-white">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-semibold">
                    Update Ticket
                </button>
            </div>

        </div>
    </form>

</x-layout>






























