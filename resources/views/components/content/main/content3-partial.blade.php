<div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="{{ $delay }}">
    <div class="text-center p-4">
        <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="{{ $icon }} fa-5x text-secondary"></i></div>
        <div class="feature-content">
            <a href="#" class="h4">{{ $title }}</a>
            <i class="fa fa-long-arrow-alt-right"></i>
            <p class="mt-4 mb-0">
                {{ $slot }}
            </p>
        </div>
    </div>
</div>