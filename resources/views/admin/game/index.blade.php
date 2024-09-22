<x-admin.layout>

    <style>
        .full-text {
            display: none;
        }
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Daftar Kartu Permainan</h5>
                <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#games">Tambah Kartu</button>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0"> 
                            <th scope="col" class="text-left">No</th>
                            <th scope="col" class="text-center">Kategori Kartu</th>
                            <th scope="col" class="text-center">Pertanyaan</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($games))
                            @foreach($games as $item)
                                <tr>
                                    <th scope="row" class="ps-0 fw-medium">
                                        <span class="table-link1 text-truncate d-block">{{ $loop->iteration }}</span>
                                    </th>
                                    <td class="text-center fw-medium">{{ $item->category }}</td>
                                    <td class="text-center fw-medium">
                                        <span class="short-text">
                                            {!! Str::limit(strip_tags($item->question), 10) !!}
                                        </span>
                                        <span class="full-text">
                                            {!! $item->question !!}
                                        </span>
                                        <a href="javascript:void(0);" class="read-more" onclick="toggleReadMore(this)">Baca Lebih Lanjut</a>
                                    </td>
                                    <td class="text-center fw-medium">
                                        <button type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#EditGame{{ $item->id }}">
                                            <span>
                                                <iconify-icon icon="solar:pen-2-bold-duotone" class="fs-6"></iconify-icon>
                                            </span>
                                        </button>
                                        <form action="{{ route('admin.games.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Apakah kamu yakin ingin menghapus kartu ini?')" method="POST">
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
                                <td colspan="4" class="text-center fw-medium">Belum ada kartu permainan</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                    {{ $games->links('pagination::bootstrap-4') }}
                </div>
            </div>
          </div>
    </div>

    <x-admin.modal id="games" labelledBy="exampleModalCenterTitle" title="Tambah Kartu">
        <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Kategori Kartu</label>
              <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" required>
              {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Isi Kartu / Pertanyaan</label>
                <textarea id="question" name="question" class="form-control @error('question') is-invalid @enderror" rows="6" required></textarea>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">Isi Jawaban</label>
                <textarea id="answer" name="answer" class="form-control @error('answer') is-invalid @enderror" rows="6" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </x-admin.modal>

    @include('admin.game.edit')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


    <script>
        $(document).ready(function() {
            function initSummernote(textarea) {
                if (!textarea.hasClass('note-initialized')) {
                    textarea.summernote({
                        height: 300,
                    });
                    textarea.addClass('note-initialized');
                }
            }

            function destroySummernote(textarea) {
                if (textarea.hasClass('note-initialized')) {
                    textarea.summernote('destroy');
                    textarea.removeClass('note-initialized');
                }
            }

            $('body').on('shown.bs.modal', function (e) {
                var modal = $(e.target);
                var questionTextarea = modal.find('textarea[name="question"]');
                var answerTextarea = modal.find('textarea[name="answer"]');

                initSummernote(questionTextarea);
                initSummernote(answerTextarea);
            });

            $('body').on('hidden.bs.modal', function (e) {
                var modal = $(e.target);
                var questionTextarea = modal.find('textarea[name="question"]');
                var answerTextarea = modal.find('textarea[name="answer"]');

                destroySummernote(questionTextarea);
                destroySummernote(answerTextarea);
            });
        });

        function toggleReadMore(el) {
            var shortText = $(el).siblings('.short-text');
            var fullText = $(el).siblings('.full-text');

            if (shortText.is(':visible')) {
                shortText.hide();
                fullText.show();
                $(el).text('Tampilkan Lebih Sedikit');
            } else {
                shortText.show();
                fullText.hide();
                $(el).text('Baca Lebih Lanjut');
            }
        }

    </script>
    
      
</x-admin.layout>