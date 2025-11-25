@props(['name', 'label' => null, 'options', 'selected' => null])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <select id="{{ $name }}" name="{{ $name }}"
        {{ $attributes->merge(['class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3']) }}
    >
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
    @enderror
</div>
