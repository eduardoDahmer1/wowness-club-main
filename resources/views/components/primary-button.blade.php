<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary p-2 text-uppercase fw-bold']) }}>
    {{ $slot }}
</button>
