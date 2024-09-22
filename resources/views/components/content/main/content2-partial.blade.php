<div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="{{ $delay }}">
    <div class="service-item text-center rounded p-4">
        <div class="service-icon d-inline-block bg-light rounded p-4 mb-4">
            <i class="{{ $icon }} fa-5x text-secondary"></i>
        </div>
        <div class="service-content">
            <h4 class="mb-4">{{ $title }}</h4>
            <p class="mb-4">{{ $slot }}</p>

            @if(isset($link) && isset($url))
                <a href="{{ $url }}" class="btn btn-light rounded-pill text-primary py-2 px-4">{{ $link }}</a>
            @endisset
            
        </div>
    </div>
</div>

