<div class="accordion-item border-0 mb-4">
    <h2 class="accordion-header" id="{{ $heading }}">
        <button class="accordion-button rounded-top collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapse }}" aria-expanded="false" aria-controls="{{ $collapse }}">
            {{ $pertanyaan }}
        </button>
    </h2>
    <div id="{{ $collapse }}" class="accordion-collapse collapse" aria-labelledby="{{ $heading }}" data-bs-parent="#accordionExample">
        <div class="accordion-body my-2">
            <h5>{{ $judul }}</h5>
            {{ $slot }}
        </div>
    </div>
</div>