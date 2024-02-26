@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'error-box']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif