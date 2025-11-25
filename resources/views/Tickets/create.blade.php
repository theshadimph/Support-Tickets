<x-layout>
    <x-slot:heading>
        Create New Support Ticket
    </x-slot:heading>

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-2xl border border-gray-200">
        <form method="POST" action="/tickets" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                {{-- Ticket Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Ticket Title (Concise Summary)</label>
                    <input id="title" name="title" type="text" required
                           value="{{ old('title') }}"
                           class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('title')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Issue Text (The Issue) --}}
                <div>
                    <label for="text" class="block text-sm font-medium text-gray-700">Detailed Issue Description</label>
                    <textarea id="text" name="text" rows="6" required
                              class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('text') }}</textarea>
                    @error('text')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Photos / Screenshots --}}
                <div>
                    <label for="photos" class="block text-sm font-medium text-gray-700">Screenshots / Attachments (Optional)</label>
                    <input id="photos" name="photos[]" type="file" multiple
                           accept="image/*, application/pdf"
                           class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100 cursor-pointer">
                    <p class="mt-1 text-xs text-gray-500">Maximum 5 files. Allowed types: Images, PDF.</p>
                    @error('photos')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-8 flex justify-between pt-6 border-t border-gray-200">
                {{-- Return Back Button --}}
                <a href="/tickets" class="inline-flex items-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition duration-150">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Cancel / Go Back
                </a>

                {{-- Submit Button --}}
                <button type="submit"
                        class="inline-flex justify-center rounded-xl border border-transparent bg-indigo-600 px-6 py-2 text-sm font-medium text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 transform hover:scale-[1.01]">
                    Submit Ticket
                </button>
            </div>
        </form>
    </div>
</x-layout>
