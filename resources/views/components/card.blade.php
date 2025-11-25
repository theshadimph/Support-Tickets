@props(['title', 'value', 'class' => 'bg-white border-gray-200'])

{{--
|--------------------------------------------------------------------------
| Card Component (x-card)
|--------------------------------------------------------------------------
| A simple component to display statistics in the dashboard.
| It supports custom classes for color coding status.
--}}
<div {{ $attributes->merge(['class' => 'p-5 rounded-xl border-l-4 shadow-md ' . $class]) }}>
    <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
    <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $value }}</p>
</div>
