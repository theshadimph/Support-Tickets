@props(['active' => false, 'type' => 'a'])

@if ($type === 'a')
    <a {{ $attributes }}
        class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium transition duration-150 ease-in-out"
        aria-current="{{ $active ? 'page' : 'false' }}"
    >
        {{ $slot }}
    </a>
@else
    {{-- Assuming type='button' for future use --}}
    <button {{ $attributes }}
        class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium transition duration-150 ease-in-out"
    >
        {{ $slot }}
    </button>
@endif
