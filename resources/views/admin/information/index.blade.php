<x-admin.layout>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Daftar Informasi</h5>
                <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#information">Tambah Informasi</button>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0"> 
                            <th scope="col" class="text-left">No</th>
                            <th scope="col" class="text-center">Judul</th>
                            <th scope="col" class="text-center">Kategori</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($information))
                            @foreach($information as $item)
                                <tr>
                                    <th scope="row" class="ps-0 fw-medium">
                                        <span class="table-link1 text-truncate d-block">{{ $loop->iteration }}</span>
                                    </th>
                                    <td class="text-center fw-medium">{{ $item->title }}</td>
                                    <td class="text-center fw-medium">{{ $item->category }}</td>
                                    <td class="text-center fw-medium">
                                        <button type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#EditInformation{{ $item->id }}">
                                            <span>
                                                <iconify-icon icon="solar:pen-2-bold-duotone" class="fs-6"></iconify-icon>
                                            </span>
                                        </button>
                                        <form action="{{ route('admin.information.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Apakah kamu yakin ingin menghapus informasi ini?')" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger m-1 border-0">
                                                <span>
                                                    <iconify-icon icon="solar:trash-bin-trash-bold-duotone" class="fs-6"></iconify-icon>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center fw-medium">Belum ada informasi</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                    {{ $information->links('pagination::bootstrap-4') }}
                </div>
            </div>
          </div>
    </div>

    <x-admin.modal id="information" labelledBy="exampleModalCenterTitle" title="Tambah Informasi">
        <form action="{{ route('admin.information.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Judul Informasi</label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" required>
              {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Kategori Informasi</label>
              <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Isi Informasi</label>
                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </x-admin.modal>

    @include('admin.information.edit')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


    <script>
        $(document).ready(function() {
            $('body').on('shown.bs.modal', function (e) {
                var modal = $(e.target);
                var textarea = modal.find('textarea');

                if (textarea.hasClass('note-editor')) {
                    textarea.summernote('destroy');
                }

                textarea.summernote({
                    height: 300,
                });
            });
        });


    </script>
      
</x-admin.layout>