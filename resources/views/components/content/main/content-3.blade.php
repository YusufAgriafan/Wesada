<div>
            <!-- Feature Start -->
            <div class="container-fluid feature overflow-hidden py-5">
                <div class="container py-5">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                        <h4 class="text-primary">{{ $kategori }}</h4>
                        <h1 class="display-5 mb-4">{{ $judul }}</h1>
                        <p class="mb-0">
                            {{ $slot }}
                        </p>
                    </div>
                    <div class="row g-4 justify-content-center text-center mb-5">
                        
                        {{ $isi }}
                        
                        @if(isset($link) && isset($url))
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="my-3">
                                    <a href="{{ $url }}" class="btn btn-primary d-inline rounded-pill px-5 py-3">{{ $link }}</a>
                                </div>
                            </div>
                        @endisset

                    </div>
                    <x-content.main.content-3-2>
                    </x-content.main.content-3-2>
                </div>
            </div>
            <!-- Feature End -->
</div>