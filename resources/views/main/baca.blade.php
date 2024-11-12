<x-layout.layout-master>
    <x-slot:title>
        Wesada - Informasi
    </x-slot>
        
    <x-slot:header>
        <x-layout.header-main breadcrumb="Informasi">
            Informasi
        </x-layout.header-main>
    </x-slot>

    <div class="container-xxl">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-5 mb-4">{{ $informasi->title }}</h1>
                    <p class="mb-4">{!! $informasi->content !!}</p>

                </div>
            </div>
        </div>
    </div>


</x-layout.layout-master>