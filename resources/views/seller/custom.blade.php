<x-seller.layout>

    <x-slot:title>
        Wesada - Custom Website
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">1. Buat Nama Usaha</h5>

                @if($existingUsaha)
                    <h6 class="mb-3">{{ $existingUsaha->name }}</h6>

                    <h5 class="card-title">2. Atur Navbar</h5>
                    <form id="dynamicForm" action="{{ route('seller.custom.link.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="inputContainer">
                            <div class="input-group">
                                <input type="text" class="form-control mb-3" name="name[]" placeholder="Nama Link" required>
                                <span class="add-input" style="cursor: pointer; color: blue; margin-left: 10px;">Tambah</span>
                                <span class="remove-input" style="cursor: pointer; color: red; margin-left: 10px;">Kurangi</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                    </form>
                    <div class="dropdown mb-4 w-100">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="navbarLinksDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Daftar Link Navbar
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="navbarLinksDropdown">
                            @foreach($links as $link)
                                <li>
                                    <a class="dropdown-item" href="{{ $link->url }}" target="_blank">
                                        {{ $link->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                @if($links->isNotEmpty())
                    <h5 class="card-title">3. Isi Konten Website</h5>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="contentDropdown" class="form-label">Pilih Konten</label>
                            <select id="contentDropdown" class="form-select" onchange="updateImage()">
                                <option value="" disabled>-- Pilih Konten --</option>
                                <option value="1">Hero</option>
                                <option value="2">Konten 1</option>
                                <option value="3">Konten 2</option>
                                <option value="4">Konten 3</option>
                                <option value="5">Konten 4</option>
                                <option value="6">Konten 5</option>
                                <option value="7">Konten 6</option>
                                <option value="8">Konten 7</option>
                                <option value="9">Konten 8</option>
                                <option value="10">Footer</option>
                            </select>
                        </div>
                        <div id="contentImage" class="mt-3">
                            <img id="selectedImage" src="" alt="Gambar Konten" style="display:none; max-width: 100%;"/>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Simpan Konten</button> --}}
                    </form>
                @endif

                @else
                    <form action="{{ route('seller.custom.name.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Usaha</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputContainer = document.getElementById('inputContainer');

            // Tambah kolom input
            inputContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('add-input')) {
                    const newInputGroup = document.createElement('div');
                    newInputGroup.classList.add('input-group');
                    newInputGroup.innerHTML = `
                        <input type="text" class="form-control mb-3" name="name[]" placeholder="Nama Usaha" required>
                        <span class="add-input" style="cursor: pointer; color: blue; margin-left: 10px;">Tambah</span>
                        <span class="remove-input" style="cursor: pointer; color: red; margin-left: 10px;">Kurangi</span>
                    `;
                    inputContainer.appendChild(newInputGroup);
                }

                // Kurangi kolom input
                if (event.target.classList.contains('remove-input')) {
                    const inputGroup = event.target.closest('.input-group');
                    if (inputGroup) {
                        inputContainer.removeChild(inputGroup);
                    }
                }
            });
        });

        function updateImage() {
            const dropdown = document.getElementById('contentDropdown');
            const selectedImage = document.getElementById('selectedImage');
            const contentImage = document.getElementById('contentImage');

            const value = dropdown.value;

            // Gambar yang sesuai untuk setiap konten
            const images = [
                '', // Placeholder untuk opsi pertama
                '{{ asset('/custom1/tampilan/hero.png') }}',
                '{{ asset('/custom1/tampilan/content1.png') }}',
                '{{ asset('/custom1/tampilan/content2.png') }}',
                '{{ asset('/custom1/tampilan/content3.png') }}',
                '{{ asset('/custom1/tampilan/content4.png') }}',
                '{{ asset('/custom1/tampilan/content5.png') }}',
                '{{ asset('/custom1/tampilan/content6.png') }}',
                '{{ asset('/custom1/tampilan/content7.png') }}',
                '{{ asset('/custom1/tampilan/content8.png') }}',
                '{{ asset('/custom1/tampilan/footer.png') }}',
            ];

            if (value) {
                selectedImage.src = images[value];
                selectedImage.style.display = 'block';
                contentImage.style.display = 'block';
            } else {
                selectedImage.src = '';
                selectedImage.style.display = 'none';
                contentImage.style.display = 'none';
            }
        }
    </script>

</x-seller.layout>