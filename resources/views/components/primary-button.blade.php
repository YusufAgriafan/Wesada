<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary w-100 py-3']) }}>
    {{ $slot }}
</button>
