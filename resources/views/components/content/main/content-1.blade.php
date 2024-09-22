<div>
    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5"  style="margin-top: 6rem;">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="RotateMoveLeft">
                        <img src="{{ asset('/main/img/about-1.png ') }}" class="img-fluid w-100" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="mb-1 text-primary">{{ $kategori }}</h4>
                    <h1 class="display-5 mb-4">{{ $judul }}</h1>
                    <p class="mb-4">
                        {{ $slot }}
                    </p>
                    <a href="{{ $url }}" class="btn btn-primary rounded-pill py-3 px-5">{{ $link }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->    
</div>