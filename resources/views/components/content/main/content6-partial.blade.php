<div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
    <div class="blog-item">
        <div class="blog-img">
            <img src="{{ asset('/main/img/blog-1.png ') }}" class="img-fluid w-100" alt="">
            <div class="blog-info">
                <span><i class="fa fa-clock"></i> {{ $tanggal }}</span>
                {{-- <div class="d-flex">
                    <span class="me-3"> 3 <i class="fa fa-heart"></i></span>
                    <a href="#" class="text-white">0 <i class="fa fa-comment"></i></a>
                </div> --}}
            </div>
        </div>
        <div class="blog-content text-dark border p-4 ">
            <h5 class="mb-4">{{ $judul }}</h5>
            <p class="mb-4">{{ $slot }}</p>
            @if(isset($link) && isset($url))
                <a class="btn btn-light rounded-pill py-2 px-4" href="{{ $url }}">{{ $link }}</a>
            @endisset
        </div>
    </div>
</div>