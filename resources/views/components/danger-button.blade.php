<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger w-100 py-3 ']) }}>
    {{ $slot }}
</button>
