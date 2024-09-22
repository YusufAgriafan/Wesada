<div>
    <!-- Service Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="mb-1 text-primary">{{ $kategori }}</h4>
                <h1 class="display-5 mb-4">{{ $judul }}</h1>
                <p class="mb-0">
                    {{ $slot }}
                </p>
            </div>

            <div class="row g-4 justify-content-center ">
                {{ $isi }}
            </div>

        </div>
    </div>
    <!-- Service End -->
</div>