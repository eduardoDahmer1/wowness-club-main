<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-options btn-delete']) }}>
    {{ $slot }}
</button>