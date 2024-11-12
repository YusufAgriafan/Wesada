<x-layout.layout-master>
    <x-slot:title>
        Wesada - Informasi
    </x-slot>
        
    <x-slot:header>
        <x-layout.header-main breadcrumb="Informasi">
            Informasi
        </x-layout.header-main>
    </x-slot>

    <x-content.main.content-6 kategori="Wesada Blog" judul="Temukan Inspirasi Kewirausahaan Terbaru">
        Dapatkan tips dan wawasan menarik seputar dunia kewirausahaan, manajemen bisnis, dan investasi. Melalui blog Wesada, 
        kami membagikan pengalaman dan pengetahuan untuk membantu Anda memulai dan mengembangkan bisnis Anda sendiri. 
        Bergabunglah dengan kami untuk artikel yang menginspirasi, studi kasus, dan panduan praktis yang relevan dengan 
        perjalanan bisnis Anda.
    
        <x-slot:isi>
            @if(count($informasi))
                @foreach($informasi as $item)
                    <x-content.main.content6-partial 
                        tanggal="{{ \Carbon\Carbon::parse($item->timestamp)->format('M d, Y') }}" 
                        judul="{{ $item->title }}" 
                        link="Baca" 
                        gambar="{{ $item->imageUrl }}"
                        url="{{ route('baca', ['title' => $item->title]) }}"
                    >
                        <p></p>
                    </x-content.main.content6-partial>
                @endforeach
            @else
                <p>Tidak ada informasi tersedia.</p>
            @endif

            {{-- <x-content.main.content6-partial tanggal="Dec 01.2024" judul="Dolor, sit amet consectetur adipisicing" link="Read More" url="#">
                <p>Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip.
                </p>
            </x-content.main.content6-partial>
    
            <x-content.main.content6-partial tanggal="Dec 01.2024" judul="Dolor, sit amet consectetur adipisicing" link="Read More" url="#">
                <p>Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip.
                </p>
            </x-content.main.content6-partial>
    
            <x-content.main.content6-partial tanggal="Dec 01.2024" judul="Dolor, sit amet consectetur adipisicing" link="Read More" url="#">
                <p>Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip.
                </p>
            </x-content.main.content6-partial>
    
            <x-content.main.content6-partial tanggal="Dec 01.2024" judul="Dolor, sit amet consectetur adipisicing" link="Read More" url="#">
                <p>Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip.
                </p>
            </x-content.main.content6-partial> --}}
        </x-slot>
    </x-content.main.content-6>

</x-layout.layout-master>