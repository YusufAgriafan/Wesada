<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<x-seller.layout>
    <x-slot:title>
        Wesada - Hitung Biaya Variabel
    </x-slot>
    <div class="container-fluid">

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
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center fw-medium">Belum ada data</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Tabel Daftar Biaya Tetap</h5>
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
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @if(count($tetap))
                            @foreach($tetap as $item)
                                <tr>
                                    <th scope="row" class="ps-0 fw-medium">
                                        <span class="table-link1 text-truncate d-block">{{ $loop->iteration }}</span>
                                    </th>
                                    <td class="text-center fw-medium">{{ $item->item }}</td>
                                    <td class="text-center fw-medium">{{ $item->kuantitas }}</td>
                                    <td class="text-center fw-medium">{{ $item->harga_satuan }}</td>
                                    <td class="text-center fw-medium">{{ $item->total_biaya }}</td>
                                    <td class="text-center fw-medium">{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center fw-medium">Belum ada data</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
                
        </div>
        <div class="card-body">
            <h5 class="card-title">Rekapitulasi Biaya dan Keuangan</h5>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0">
                    <thead>
                        <tr class="border-2 border-bottom border-primary border-0"> 
                            <th scope="col" class="text-center">Jenis Biaya/Indikator</th>
                            <th scope="col" class="text-center">Nilai (Rp)</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center fw-medium">Biaya Variabel</td>
                            <td class="text-center fw-medium">{{ number_format($totalBiayaVariabel, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Biaya Tetap</td>
                            <td class="text-center fw-medium">{{ number_format($totalBiayaTetap, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Harga Jual</td>
                            <td class="text-center fw-medium">{{ number_format($hargaJual, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Harga Pokok Penjualan (HPP)</td>
                            <td class="text-center fw-medium">{{ number_format($hpp, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Break Even Point (BEP) Unit</td>
                            <td class="text-center fw-medium">{{ number_format($bepUnit, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Break Even Point (BEP) Rupiah</td>
                            <td class="text-center fw-medium">{{ number_format($bepRupiah, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Perkiraan Penjualan</td>
                            <td class="text-center fw-medium">{{ number_format($perkiraanPenjualan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Total Biaya Produksi</td>
                            <td class="text-center fw-medium">{{ number_format($biayaProduksi, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Laba Usaha</td>
                            <td class="text-center fw-medium">{{ number_format($labaUsaha, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Laba Kotor</td>
                            <td class="text-center fw-medium">{{ number_format($labaKotor, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">B/C Ratio</td>
                            <td class="text-center fw-medium">{{ number_format($BCRatio, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Gross Profit Margin</td>
                            <td class="text-center fw-medium">{{ number_format($grosProfitMargin, 2, ',', '.') }}%</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-medium">Net Profit Margin</td>
                            <td class="text-center fw-medium">{{ number_format($netProfitMargin, 2, ',', '.') }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        

    </div>

    <script>
        // Ambil nilai dari elemen HTML
        const variableCost = parseFloat(document.getElementById('variable-cost').textContent.trim().replace(',', '').replace('Rp', '')) || 0;
        const fixedCost = parseFloat(document.getElementById('fixed-cost').textContent.trim().replace(',', '').replace('Rp', '')) || 0;
    
        // Hitung total biaya
        const totalRab = variableCost + fixedCost;
    
        // Tampilkan total biaya di tabel dengan format yang benar
        document.getElementById('total-rab').textContent = 'Rp ' + totalRab.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    </script>
</x-seller.layout>
