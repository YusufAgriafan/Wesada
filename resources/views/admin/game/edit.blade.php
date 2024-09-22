@foreach($games as $item)

<x-admin.modal id="EditGame{{ $item->id }}" labelledBy="exampleModalCenterTitle" title="Edit Kartu">
    <form action="{{ route('admin.games.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Kategori Kartu</label>
          <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" required value="{{ $item->category }}">
        </div>
        <div class="mb-3">
            <label for="question" class="form-label">Isi Kartu / Pertanyaan</label>
            <textarea id="question" name="question" class="form-control @error('question') is-invalid @enderror" rows="6" required>{{ str_replace('<br />', "", nl2br($item->question)) }}</textarea>
        </div>
        <div class="mb-3">
          <label for="answer" class="form-label">Isi Jawaban</label>
          <textarea id="answer" name="answer" class="form-control @error('answer') is-invalid @enderror" rows="6" required>{{ str_replace('<br />', "", nl2br($item->answer)) }}</textarea>
      </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-admin.modal>

@endforeach
