@foreach($information as $item)

<x-admin.modal id="EditInformation{{ $item->id }}" labelledBy="exampleModalCenterTitle" title="Edit Informasi">
    <form action="{{ route('admin.information.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Judul Informasi</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" required value="{{ $item->title }}">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Kategori Informasi</label>
          <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" required value="{{ $item->category }}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Isi Informasi</label>
            <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required>{{ str_replace('<br />', "", nl2br($item->content)) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-admin.modal>

@endforeach
