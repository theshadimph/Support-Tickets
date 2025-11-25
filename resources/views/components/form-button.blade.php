<button
    {{ $attributes->merge(['class' => "px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-semibold", 'type' => 'submit'])}}


>{{$slot}}
</button>
