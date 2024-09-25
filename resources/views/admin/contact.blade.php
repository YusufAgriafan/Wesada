<x-admin.layout>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Daftar Pesan</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0"> 
                            <th scope="col" class="text-left">No</th>
                            <th scope="col" class="text-center">Nama</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Nomor Telepon</th>
                            <th scope="col" class="text-center">Subjek</th>
                            <th scope="col" class="text-center">Pesan</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($contact))
                            @foreach($contact as $item)
                                <tr>
                                    <th scope="row" class="ps-0 fw-medium">
                                        <span class="table-link1 text-truncate d-block">{{ $loop->iteration }}</span>
                                    </th>
                                    <td class="text-center fw-medium">{{ $item->nama }}</td>
                                    <td class="text-center fw-medium">{{ $item->email }}</td>
                                    <td class="text-center fw-medium">{{ $item->nomor }}</td>
                                    <td class="text-center fw-medium">{{ $item->subjek }}</td>
                                    <td class="text-center fw-medium">{{ $item->pesan }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center fw-medium">Belum ada pesan</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                    {{ $contact->links('pagination::bootstrap-4') }}
                </div>
            </div>
          </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    
      
</x-admin.layout>