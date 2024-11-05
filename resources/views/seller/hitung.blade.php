<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<x-seller.layout>
    <x-slot:title>
        Wesada - Hitung
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h5 class="card-title">Hitung Harga Jual
                    {{-- <i id="hargaJual" class="fas fa-question-circle tooltip-icon" style="cursor: pointer; color: gray; margin-left: 10px;"></i> --}}
                </h5>
                {{-- <h3>Total Biaya: Rp {{ number_format($totalBiaya, 2, ',', '.') }}</h3> --}}

                <form id="dynamicForm" action="{{ route('seller.hargaJual.store') }}" method="POST">
                    @csrf

                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-4">
                            <label><b>Biaya Variabel Per Unit (BV unit)</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="total_biaya_variabel" placeholder="Total Biaya Variabel (Rp)" readonly value="{{ $totalBiaya }}">
                        </div>
                        <h4>/</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="jumlah_produk" id="jumlahProduk" placeholder="Jumlah Produk" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" id="biayaVariabelUnit" placeholder="BV unit (Rp)" readonly>
                        </div>
                    </div>

                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-4">
                            <label><b>Harga Jual</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-2">
                            <input type="number" class="form-control" id="hargaJualBV" placeholder="BV unit (Rp)" readonly>
                        </div>
                        <span>(</span>
                        <div class="col-md-2">
                            <input type="number" class="form-control" id="hargaJualBV2" placeholder="BV unit (Rp)" readonly>
                        </div>
                        <h4>x</h4>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="presentase" id="presentase" placeholder="Presentase Keuntungan (%)" min="0" required>
                        </div>
                        <span>% )</span>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="hargaJual" name="harga_jual" placeholder="Harga Jual (Rp)" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Hitung Harga Pokok Penjualan (HPP)
                    {{-- <i id="hargaJual" class="fas fa-question-circle tooltip-icon" style="cursor: pointer; color: gray; margin-left: 10px;"></i> --}}
                </h5>
                {{-- <h3>Total Biaya: Rp {{ number_format($totalBiaya, 2, ',', '.') }}</h3> --}}

                <form id="dynamicForm" action="{{ route('seller.hpp.store') }}" method="POST">
                    @csrf

                    <!-- Harga Pokok Penjualan (HPP) -->
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Harga Pokok Penjualan (HPP)</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="persediaan_awal" id="persediaan_awal" placeholder="Persediaan Awal (Rp)" min="1" required>
                        </div>
                        <h4>+</h4>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="total_biaya_variabel" placeholder="Total Biaya Variabel (Rp)" readonly value="{{ $totalBiaya }}">
                        </div>
                        <h4>-</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="persediaan_akhir" name="persediaan_akhir" placeholder="Persediaan Akhir (Rp)" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="hpp" name="hpp" placeholder="HPP (Rp)" readonly>
                        </div>
                    </div>

                    <!-- HPP Per Unit -->
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>HPP Per Unit</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-4">
                            <input type="number" class="form-control" id="hpp_display" placeholder="HPP (Rp)" readonly>
                        </div>
                        <h4>/</h4>
                        <div class="col-md-4">
                            <input type="number" class="form-control" name="jumlah_produk" id="jumlahProduk" placeholder="Jumlah Produk" readonly value="{{ $jumlahProduk }}">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="hpp_unit" name="hpp_unit" placeholder="HPP Unit (Rp)" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
    
                <h5 class="card-title">Hitung Break Event Point (BEP) Unit
                    {{-- <i id="hargaJual" class="fas fa-question-circle tooltip-icon" style="cursor: pointer; color: gray; margin-left: 10px;"></i> --}}
                </h5>
    
                <form id="dynamicForm" action="{{ route('seller.bepUnit.store') }}" method="POST">
                    @csrf
    
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Break Event Point (BEP) Unit</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="total_biaya_tetap" placeholder="Total Biaya Tetap (Rp)" readonly value="{{ $totalBiayaTetap }}">
                        </div>
                        <h4>/</h4>
                        <span><h4>(</h4></span>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="harga_jual" placeholder="Harga Jual (Rp)" readonly value="{{ $hargaJual }}">
                            </div>
                            <h4>-</h4>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="biaya_variabel_unit" placeholder="Biaya Variabel Per Unit (Rp)" readonly value="{{ $BVunit }}">
                            </div>
                        <span><h4>)</h4></span>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bep" name="bep" placeholder="BEP Unit (Rp)" readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
    
                <h5 class="card-title">Hitung Break Event Point (BEP) Rupiah
                    {{-- <i id="hargaJual" class="fas fa-question-circle tooltip-icon" style="cursor: pointer; color: gray; margin-left: 10px;"></i> --}}
                </h5>
    
                <form id="dynamicForm" action="{{ route('seller.bepRupiah.store') }}" method="POST">
                    @csrf
    
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Break Event Point (BEP) Rupiah</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="total_biaya_tetap" placeholder="Total Biaya Tetap (Rp)" readonly value="{{ $totalBiayaTetap }}">
                        </div>
                        <h4>/</h4>
                        <span><h4>(</h4></span>
                            <h4>1</h4>
                            <h4>-</h4>
                            <span><h4>(</h4></span>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="biaya_variabel_unit" placeholder="Biaya Variabel Per Unit (Rp)" readonly value="{{ $BVunit }}">
                                </div>
                                <h4>/</h4>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="harga_jual" placeholder="Harga Jual (Rp)" readonly value="{{ $hargaJual }}">
                                </div>
                            <span><h4>)</h4></span>
                        <span><h4>)</h4></span>
                        {{-- <div class="col-md-3">
                            <input type="number" class="form-control" id="bepRupiah" name="bep_rupiah" placeholder="BEP Rupiah (Rp)" readonly>
                        </div> --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
    
                <h5 class="card-title">Hitung Perkiraan Penjualan
                    {{-- <i id="hargaJual" class="fas fa-question-circle tooltip-icon" style="cursor: pointer; color: gray; margin-left: 10px;"></i> --}}
                </h5>
    
                <form id="dynamicForm" action="{{ route('seller.perkiraanPenjualan.store') }}" method="POST">
                    @csrf
    
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Perkiraan Penjualan</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="harga_jual" id="perkiraan_penjualanharga_jual" placeholder="Harga Jual (Rp)" readonly value="{{ $hargaJual }}">
                        </div>
                        <h4>x</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="jumlah_produk" id="perkiraan_penjualanjumlah_produk" placeholder="Jumlah Produk" readonly value="{{ $jumlahProduk }}">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="perkiraan_penjualan" name="perkiraan_penjualan" placeholder="Perkiraan Penjualan (Rp)" readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
    
                <h5 class="card-title">Hitung Total Biaya Produksi Selama 1 Periode
                    {{-- <i id="hargaJual" class="fas fa-question-circle tooltip-icon" style="cursor: pointer; color: gray; margin-left: 10px;"></i> --}}
                </h5>
    
                <form id="dynamicForm" action="{{ route('seller.biayaProduksi.store') }}" method="POST">
                    @csrf
    
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Total Biaya Produksi</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="persediaan_awal" id="biaya_produksipersediaan_awal" placeholder="Persediaan Awal (Rp)" min="1" required>
                        </div>
                        <h4>+</h4>
                        <div class="col-md-2">
                            <input type="number" class="form-control" id="biaya_produksitotal_biaya_variabel" name="total_biaya_variabel" placeholder="Total Biaya Variabel (Rp)" readonly value="{{ $totalBiaya }}">
                        </div>
                        <h4>-</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="biaya_produksipersediaan_akhir" name="persediaan_akhir" placeholder="Persediaan Akhir (Rp)" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="biaya_produksi" name="biaya_produksi" placeholder="Biaya Produksi (Rp)" readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
        
                <h5 class="card-title">Hitung Laba</h5>
        
                <form id="dynamicForm" action="{{ route('seller.calculateAndStore.store') }}" method="POST">
                    @csrf
        
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Laba Bersih</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="perkiraan_penjualan" id="laba_usahaperkiraan_penjualan" placeholder="Perkiraan Penjualan (Rp)" readonly value="{{ $perkiraanPenjualan }}">
                        </div>
                        <h4>-</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="laba_usahabiaya_produksi" name="biaya_produksi" placeholder="Biaya Produksi (Rp)" readonly value="{{ $biayaProduksi }}">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="laba_usaha" name="laba_usaha" placeholder="Laba Bersih (Rp)" readonly>
                        </div>
                    </div>
        
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Laba Kotor</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="perkiraan_penjualan_laba_kotor" id="laba_kotorperkiraan_penjualan" placeholder="Perkiraan Penjualan (Rp)" readonly value="{{ $perkiraanPenjualan }}">
                        </div>
                        <h4>-</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="laba_kotorhpp" name="hpp" placeholder="HPP (Rp)" readonly value="{{ $hpp }}">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="laba_kotor" name="laba_kotor" placeholder="Laba Kotor (Rp)" readonly>
                        </div>
                    </div>
        
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>BC Ratio</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="perkiraan_penjualan_bc" id="bc_ratio_perkiraan_penjualan" placeholder="Perkiraan Penjualan (Rp)" readonly value="{{ $perkiraanPenjualan }}">
                        </div>
                        <h4>/</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bc_ratio_biaya_produksi" name="biaya_produksi_bc" placeholder="Biaya Produksi (Rp)" readonly value="{{ $biayaProduksi }}">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="bc_ratio" name="bc_ratio" placeholder="BC Ratio" readonly>
                        </div>
                    </div>
        
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Gross Profit Margin</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="laba_kotor_gross" id="laba_kotor_gross" placeholder="Laba Kotor (Rp)" readonly value="{{ old('laba_kotor') }}">
                        </div>
                        <h4>/</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="gross_profit_margin_perkiraan_penjualan" name="perkiraan_penjualan_gross" placeholder="Perkiraan Penjualan (Rp)" readonly value="{{ $perkiraanPenjualan }}">
                        </div>
                        <h4>* 100</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="gross_profit_margin" name="gross_profit_margin" placeholder="Gross Profit Margin (%)" readonly>
                        </div>
                    </div>
        
                    <div class="form-row mb-3 align-items-center">
                        <div class="col-md-3">
                            <label><b>Net Profit Margin</b></label>
                        </div>
                        <h4>=</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="laba_usaha_net" id="laba_usaha_net" placeholder="Laba Usaha (Rp)" readonly value="{{ old('laba_usaha') }}">
                        </div>
                        <h4>/</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="net_profit_margin_perkiraan_penjualan" name="perkiraan_penjualan_net" placeholder="Perkiraan Penjualan (Rp)" readonly value="{{ $perkiraanPenjualan }}">
                        </div>
                        <h4>* 100</h4>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="net_profit_margin" name="net_profit_margin" placeholder="Net Profit Margin (%)" readonly>
                        </div>
                    </div>
        
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        

    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jumlahProdukInput = document.getElementById('jumlahProduk');
            const presentaseInput = document.getElementById('presentase');
            const biayaVariabelUnitInput = document.getElementById('biayaVariabelUnit');
            const hargaJualBVInput = document.getElementById('hargaJualBV');
            const hargaJualBVInput2 = document.getElementById('hargaJualBV2');
            const hargaJualInput = document.getElementById('hargaJual');
            const totalBiaya = {{ $totalBiaya }};

            function calculateBiayaVariabelUnit() {
                const jumlahProduk = parseFloat(jumlahProdukInput.value) || 0;
                const biayaVariabelUnit = jumlahProduk > 0 ? totalBiaya / jumlahProduk : 0;
                biayaVariabelUnitInput.value = biayaVariabelUnit.toFixed(2);
                hargaJualBVInput.value = biayaVariabelUnit.toFixed(2);
                hargaJualBVInput2.value = biayaVariabelUnit.toFixed(2);
                calculateHargaJual();
            }

            function calculateHargaJual() {
                const presentase = parseFloat(presentaseInput.value) || 0;
                const biayaVariabelUnit = parseFloat(biayaVariabelUnitInput.value) || 0;
                const hargaJual = biayaVariabelUnit + (biayaVariabelUnit * presentase / 100);
                hargaJualInput.value = hargaJual.toFixed(2);
            }

            jumlahProdukInput.addEventListener('input', calculateBiayaVariabelUnit);
            presentaseInput.addEventListener('input', calculateHargaJual);
        });

        document.addEventListener('DOMContentLoaded', function () {
        const persediaanAwalInput = document.getElementById('persediaan_awal');
        const persediaanAkhirInput = document.getElementById('persediaan_akhir');
        const hppInput = document.getElementById('hpp');
        const hppDisplayInput = document.getElementById('hpp_display');
        const jumlahProdukInput = document.getElementById('jumlahProduk');
        const hppUnitInput = document.getElementById('hpp_unit');
        const totalBiaya = parseFloat("{{ $totalBiaya }}");
        const jumlahProduk = parseFloat("{{ $jumlahProduk }}");

        function calculateHPP() {
            const persediaanAwal = parseFloat(persediaanAwalInput.value) || 0;
            const persediaanAkhir = parseFloat(persediaanAkhirInput.value) || 0;
            const hpp = persediaanAwal + totalBiaya - persediaanAkhir;
            hppInput.value = hpp.toFixed(2);
            hppDisplayInput.value = hpp.toFixed(2);
            calculateHPPPerUnit(hpp);
        }

        function calculateHPPPerUnit(hpp) {
            if (jumlahProduk > 0) {
                const hppPerUnit = hpp / jumlahProduk;
                hppUnitInput.value = hppPerUnit.toFixed(2);
            } else {
                hppUnitInput.value = 0;
            }
        }

        persediaanAwalInput.addEventListener('input', calculateHPP);
        persediaanAkhirInput.addEventListener('input', calculateHPP);
    });

    // BEP
    document.addEventListener('DOMContentLoaded', function () {
        const totalBiayaTetapInput = document.querySelector('input[name="total_biaya_tetap"]');
        const hargaJualInput = document.querySelector('input[name="harga_jual"]');
        const biayaVariabelUnitInput = document.querySelector('input[name="biaya_variabel_unit"]');
        const bepUnitInput = document.getElementById('bep');
        const bepRupiahInput = document.getElementById('bepRupiah');

        // Kalkulasi BEP Unit
        function calculateBEPUnit() {
            const totalBiayaTetap = parseFloat(totalBiayaTetapInput.value) || 0;
            const hargaJual = parseFloat(hargaJualInput.value) || 0;
            const biayaVariabelUnit = parseFloat(biayaVariabelUnitInput.value) || 0;

            // Cek apakah denominator tidak nol
            if (hargaJual - biayaVariabelUnit !== 0) {
                const bepUnit = totalBiayaTetap / (hargaJual - biayaVariabelUnit);
                bepUnitInput.value = bepUnit.toFixed(2);
            }
        }

        // Kalkulasi BEP Rupiah
        // function calculateBEPRupiah() {
        //     const totalBiayaTetap = parseFloat(totalBiayaTetapInput.value) || 0;
        //     const hargaJual = parseFloat(hargaJualInput.value) || 0;
        //     const biayaVariabelUnit = parseFloat(biayaVariabelUnitInput.value) || 0;

        //     if (hargaJual !== 0) {
        //         const bepRupiah = totalBiayaTetap / (hargaJual - biayaVariabelUnit);
        //         bepRupiahInput.value = bepRupiah.toFixed(2);
        //     }
        // }

        calculateBEPUnit();
        // calculateBEPRupiah();

        totalBiayaTetapInput.addEventListener('input', calculateBEPUnit);
        hargaJualInput.addEventListener('input', calculateBEPUnit);
        biayaVariabelUnitInput.addEventListener('input', calculateBEPUnit);

        // totalBiayaTetapInput.addEventListener('input', calculateBEPRupiah);
        // hargaJualInput.addEventListener('input', calculateBEPRupiah);
        // biayaVariabelUnitInput.addEventListener('input', calculateBEPRupiah);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const hargaJualInput = document.getElementById('perkiraan_penjualanharga_jual');
        const jumlahProdukInput = document.getElementById('perkiraan_penjualanjumlah_produk');
        const perkiraanPenjualanInput = document.getElementById('perkiraan_penjualan');

        function calculatePerkiraanPenjualan() {
            const hargaJual = parseFloat(hargaJualInput.value) || 0;
            const jumlahProduk = parseFloat(jumlahProdukInput.value) || 0;

            const perkiraanPenjualan = hargaJual * jumlahProduk;
            perkiraanPenjualanInput.value = perkiraanPenjualan.toFixed(2);
        }

        calculatePerkiraanPenjualan();

        jumlahProdukInput.addEventListener('input', calculatePerkiraanPenjualan);
    });

    // Hitung Total Biaya Produksi
    document.addEventListener('DOMContentLoaded', function () {
        const persediaanAwalInput = document.getElementById('biaya_produksipersediaan_awal');
        const totalBiayaVariabelInput = document.getElementById('biaya_produksitotal_biaya_variabel');
        const persediaanAkhirInput = document.getElementById('biaya_produksipersediaan_akhir');
        const biayaProduksiInput = document.getElementById('biaya_produksi');

        function calculateBiayaProduksi() {
            const persediaanAwal = parseFloat(persediaanAwalInput.value) || 0;
            const totalBiayaVariabel = parseFloat(totalBiayaVariabelInput.value) || 0;
            const persediaanAkhir = parseFloat(persediaanAkhirInput.value) || 0;

            const biayaProduksi = persediaanAwal + totalBiayaVariabel - persediaanAkhir;
            biayaProduksiInput.value = biayaProduksi.toFixed(2);
        }

        calculateBiayaProduksi();

        persediaanAwalInput.addEventListener('input', calculateBiayaProduksi);
        persediaanAkhirInput.addEventListener('input', calculateBiayaProduksi);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const perkiraanPenjualanInput = document.getElementById('laba_usahaperkiraan_penjualan');
        const totalBiayaProduksiInput = document.getElementById('laba_usahabiaya_produksi');
        const labaUsahaInput = document.getElementById('laba_usaha');
        const totalBiayaProduksiKotorInput = document.getElementById('laba_kotorperkiraan_penjualan');
        const totalHppInput = document.getElementById('laba_kotorhpp');
        const totalKotorInput = document.getElementById('laba_kotor');
        const bcRatioPenjualanInput = document.getElementById('bc_ratio_perkiraan_penjualan');
        const bcRatioBiayaInput = document.getElementById('bc_ratio_biaya_produksi');
        const bcRatioInput = document.getElementById('bc_ratio');
        const grossProfitMarginInput = document.getElementById('gross_profit_margin');
        const netProfitMarginInput = document.getElementById('net_profit_margin');
        const labaKotorGrossInput = document.getElementById('laba_kotor_gross');
        const labaUsahaNetInput = document.getElementById('laba_usaha_net');

        function calculateLabaBersih() {
            const perkiraanPenjualan = parseFloat(perkiraanPenjualanInput.value) || 0;
            const totalBiayaProduksi = parseFloat(totalBiayaProduksiInput.value) || 0;

            const labaBersih = perkiraanPenjualan - totalBiayaProduksi;
            labaUsahaInput.value = labaBersih.toFixed(2);
            return labaBersih;
        }

        function calculateLabaKotor() {
            const totalBiayaProduksiKotor = parseFloat(totalBiayaProduksiKotorInput.value) || 0;
            const totalHpp = parseFloat(totalHppInput.value) || 0;

            const labaKotor = totalBiayaProduksiKotor - totalHpp;
            totalKotorInput.value = labaKotor.toFixed(2);
            return labaKotor;
        }

        function calculateBCRatio() {
            const perkiraanPenjualan = parseFloat(bcRatioPenjualanInput.value) || 0;
            const biayaProduksi = parseFloat(bcRatioBiayaInput.value) || 0;

            const bcRatio = biayaProduksi > 0 ? perkiraanPenjualan / biayaProduksi : 0;
            bcRatioInput.value = bcRatio.toFixed(2);
        }

        function calculateGrossProfitMargin() {
            const labaKotor = parseFloat(totalKotorInput.value) || 0;
            const perkiraanPenjualan = parseFloat(bcRatioPenjualanInput.value) || 0;

            const grossProfitMargin = perkiraanPenjualan > 0 ? (labaKotor / perkiraanPenjualan) * 100 : 0; 
            grossProfitMarginInput.value = grossProfitMargin.toFixed(2);
            labaKotorGrossInput.value = labaKotor.toFixed(2);
        }

        function calculateNetProfitMargin() {
            const labaUsaha = parseFloat(labaUsahaInput.value) || 0;
            const perkiraanPenjualan = parseFloat(bcRatioPenjualanInput.value) || 0;

            const netProfitMargin = perkiraanPenjualan > 0 ? (labaUsaha / perkiraanPenjualan) * 100 : 0; // Hindari pembagian dengan nol
            netProfitMarginInput.value = netProfitMargin.toFixed(2);
            labaUsahaNetInput.value = labaUsaha.toFixed(2);
        }

        // Event listeners untuk semua input
        perkiraanPenjualanInput.addEventListener('input', () => {
            calculateLabaBersih();
            calculateBCRatio();
            calculateGrossProfitMargin();
            calculateNetProfitMargin();
        });

        totalBiayaProduksiInput.addEventListener('input', () => {
            calculateLabaBersih();
            calculateBCRatio();
        });

        totalBiayaProduksiKotorInput.addEventListener('input', () => {
            calculateLabaKotor();
            calculateGrossProfitMargin();
        });

        totalHppInput.addEventListener('input', () => {
            calculateLabaKotor();
            calculateGrossProfitMargin();
        });

        bcRatioPenjualanInput.addEventListener('input', calculateBCRatio);
        bcRatioBiayaInput.addEventListener('input', calculateBCRatio);
        
        // Inisialisasi awal
        calculateLabaBersih();
        calculateLabaKotor();
        calculateBCRatio();
        calculateGrossProfitMargin();
        calculateNetProfitMargin();
    });

    


        
    </script>
</x-seller.layout>
