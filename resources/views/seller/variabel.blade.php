<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<x-seller.layout>
    <x-slot:title>
        Wesada - Hitung Biaya Variabel
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h5 class="card-title">Hitung Biaya Variabel
                    <i id="tooltipIcon" class="fas fa-question-circle tooltip-icon" style="cursor: pointer; color: gray; margin-left: 10px;"></i>
                </h5>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="dynamicForm" action="{{ route('seller.variabel.store') }}" method="POST">
                    @csrf
                    <div class="form-row d-none d-md-flex mb-3 font-weight-bold">
                        <div class="col-md-2 d-flex justify-content-around">Item</div>
                        <div class="col-md-2 d-flex justify-content-around">Kuantitas</div>
                        <div class="col-md-2 d-flex justify-content-around">Harga Satuan (Rp)</div>
                        <div class="col-md-2 d-flex justify-content-around">Total Biaya (Rp)</div>
                        <div class="col-md-2 d-flex justify-content-around">Keterangan</div>
                        <div class="col-md-2 d-flex justify-content-around">Aksi</div>
                    </div>
                    <div id="inputContainer">
                        <div class="form-row mb-3">
                            <div class="col-12 col-md-2 mb-2">
                                <input type="text" class="form-control" name="item[]" placeholder="Nama Item" required>
                            </div>
                            <div class="col-6 col-md-2 mb-2">
                                <input type="number" class="form-control" name="kuantitas[]" placeholder="Kuantitas" min="0" onchange="calculateTotal(this)" required>
                            </div>
                            <div class="col-6 col-md-2 mb-2">
                                <input type="number" class="form-control" name="harga_satuan[]" placeholder="Harga Satuan (Rp)" step="0.01" min="0" onchange="calculateTotal(this)" required>
                            </div>
                            <div class="col-12 col-md-2 mb-2">
                                <input type="number" class="form-control total-biaya" name="total_biaya[]" placeholder="Total Biaya (Rp)" readonly>
                            </div>
                            <div class="col-12 col-md-2 mb-2">
                                <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan">
                            </div>
                            <div class="col-12 col-md-2 d-flex justify-content-around">
                                <span class="add-input" style="cursor: pointer; color: blue;">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="remove-input" style="cursor: pointer; color: red;">
                                    <i class="fas fa-minus"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Daftar Harga Variabel</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0"> 
                            <th scope="col" class="text-left">No</th>
                            <th scope="col" class="text-center">Nama Item</th>
                            <th scope="col" class="text-center">Kuantitas</th>
                            <th scope="col" class="text-center">Harga Satuan (Rp)</th>
                            <th scope="col" class="text-center">Total Biaya (Rp)</th>
                            <th scope="col" class="text-center">Keterangan</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($variabel))
                            @foreach($variabel as $item)
                                <tr>
                                    <th scope="row" class="ps-0 fw-medium">
                                        <span class="table-link1 text-truncate d-block">{{ $loop->iteration }}</span>
                                    </th>
                                    <td class="text-center fw-medium">{{ $item->item }}</td>
                                    <td class="text-center fw-medium">{{ $item->kuantitas }}</td>
                                    <td class="text-center fw-medium">{{ $item->harga_satuan }}</td>
                                    <td class="text-center fw-medium">{{ $item->total_biaya }}</td>
                                    <td class="text-center fw-medium">{{ $item->keterangan }}</td>
                                    <td class="text-center fw-medium">
                                        <form action="{{ route('seller.variabel.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Apakah kamu yakin ingin menghapus item ini?')" method="POST">
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
                                <td colspan="7" class="text-center fw-medium">Belum ada data</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
          </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputContainer = document.getElementById('inputContainer');

            inputContainer.addEventListener('click', function (event) {
                if (event.target.closest('.add-input')) {
                    const newInputGroup = document.createElement('div');
                    newInputGroup.classList.add('form-row', 'mb-3');
                    newInputGroup.innerHTML = `
                        <div class="col-12 col-md-2 mb-2">
                            <input type="text" class="form-control" name="item[]" placeholder="Nama Item" required>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <input type="number" class="form-control" name="kuantitas[]" placeholder="Kuantitas" min="0" onchange="calculateTotal(this)" required>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <input type="number" class="form-control" name="harga_satuan[]" placeholder="Harga Satuan (Rp)" step="0.01" min="0" onchange="calculateTotal(this)" required>
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                            <input type="number" class="form-control total-biaya" name="total_biaya[]" placeholder="Total Biaya (Rp)" readonly>
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan">
                        </div>
                        <div class="col-12 col-md-2 d-flex justify-content-around">
                            <span class="add-input" style="cursor: pointer; color: blue;">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="remove-input" style="cursor: pointer; color: red;">
                                <i class="fas fa-minus"></i>
                            </span>
                        </div>
                    `;
                    inputContainer.appendChild(newInputGroup);
                }

                if (event.target.closest('.remove-input')) {
                    const inputGroup = event.target.closest('.form-row');
                    if (inputGroup) {
                        inputContainer.removeChild(inputGroup);
                    }
                }
            });
        });

        function calculateTotal(element) {
            const inputGroup = element.closest('.form-row');
            const quantity = parseFloat(inputGroup.querySelector('input[name="kuantitas[]"]').value) || 0;
            const price = parseFloat(inputGroup.querySelector('input[name="harga_satuan[]"]').value) || 0;
            const total = quantity * price;

            inputGroup.querySelector('.total-biaya').value = total.toFixed(2);
        }

        tooltipIcon.addEventListener('click', function () {
                alert('Biaya yang berubah seiring dengan tingkat produksi atau penjualan. Semakin banyak produk yang diproduksi, semakin tinggi biaya ini. biaya yang bisa berubah misal bahan baku, biaya produksi.');
            });
    </script>
</x-seller.layout>
