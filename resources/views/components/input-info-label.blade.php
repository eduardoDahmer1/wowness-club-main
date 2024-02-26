@props(['value'])

<p {{ $attributes->merge(['class' => 'info-label']) }}>
    {{ $value ?? $slot }}
</p>
