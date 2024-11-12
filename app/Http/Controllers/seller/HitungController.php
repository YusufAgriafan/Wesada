<?php

namespace App\Http\Controllers\seller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\HitungBiayaVariabel;
use App\Models\HitungBiayaTetap;
use App\Models\HitungHargaJual;
use App\Models\HitungHpp;
use App\Models\HitungBep;
use App\Models\HitungBiayaProduksi;
use App\Models\HitungLabaUsaha;
use App\Models\HitungBepRupiah;
use App\Models\HitungPerkiraanPenjualan;
use App\Models\HitungLabaKotor;
use App\Models\HitungBcRatio;
use App\Models\HitungNetProfitMargin;
use App\Models\HitungGrosProfitMargin;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function variabel()
    {
        $variabel = HitungBiayaVariabel::latest()->get();
        return view('seller.variabel', compact('variabel'));
    }

    public function variabelStore(Request $request)
    {
        $request->validate([
            'item.*' => 'required|string|max:255',
            'kuantitas.*' => 'required|integer|min:0',
            'harga_satuan.*' => 'required|numeric|min:0',
            'total_biaya.*' => 'nullable|numeric|min:0',
            'keterangan.*' => 'nullable|string'
        ]);

        // dd($request->all());

        $user_id = Auth::id();

        foreach ($request->item as $index => $item) {
            $kuantitas = $request->kuantitas[$index];
            $harga_satuan = $request->harga_satuan[$index];
            $total_biaya = $request->total_biaya[$index] ?? $kuantitas * $harga_satuan;

            try {
                HitungBiayaVariabel::create([
                    'item' => $item,
                    'kuantitas' => $kuantitas,
                    'harga_satuan' => $harga_satuan,
                    'total_biaya' => $total_biaya,
                    'keterangan' => $request->keterangan[$index],
                    'user_id' => $user_id,
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
            }
        }

        return redirect()->route('seller.variabel')->with('success', 'Data biaya variabel berhasil disimpan.');
    }

    public function variabelDestroy($id)
    {
        $variabel = HitungBiayaVariabel::findOrFail($id);
        $variabel->delete();
        return redirect()->route('seller.variabel')->with('success', 'Data biaya variabel berhasil dihapus!');
    }

    public function tetap()
    {
        $tetap = HitungBiayaTetap::latest()->get();
        return view('seller.tetap', compact('tetap'));
    }

    public function tetapStore(Request $request)
    {
        $request->validate([
            'item.*' => 'required|string|max:255',
            'kuantitas.*' => 'required|integer|min:0',
            'harga_satuan.*' => 'required|numeric|min:0',
            'total_biaya.*' => 'nullable|numeric|min:0',
            'keterangan.*' => 'nullable|string'
        ]);

        // dd($request->all());

        $user_id = Auth::id();

        foreach ($request->item as $index => $item) {
            $kuantitas = $request->kuantitas[$index];
            $harga_satuan = $request->harga_satuan[$index];
            $total_biaya = $request->total_biaya[$index] ?? $kuantitas * $harga_satuan;

            try {
                HitungBiayaTetap::create([
                    'item' => $item,
                    'kuantitas' => $kuantitas,
                    'harga_satuan' => $harga_satuan,
                    'total_biaya' => $total_biaya,
                    'keterangan' => $request->keterangan[$index],
                    'user_id' => $user_id,
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
            }
        }

        return redirect()->route('seller.tetap')->with('success', 'Data biaya tetap berhasil disimpan.');
    }

    public function tetapDestroy($id)
    {
        $tetap = HitungBiayaTetap::findOrFail($id);
        $tetap->delete();
        return redirect()->route('seller.tetap')->with('success', 'Data biaya tetap berhasil dihapus!');
    }

    public function hitung()
    {
        $user_id = Auth::id();

        $totalBiaya = DB::table('hitung_biaya_variabel')
                        ->where('user_id', $user_id)
                        ->sum('total_biaya');
        $BVunit = DB::table('hitung_harga_jual')
                        ->where('user_id', $user_id)
                        ->sum('biaya_variabel_unit');
        $totalBiayaTetap = DB::table('hitung_biaya_tetap')
                        ->where('user_id', $user_id)
                        ->sum('total_biaya');
        $jumlahProduk = DB::table('hitung_harga_jual')
                        ->where('user_id', $user_id)
                        ->value('jumlah_produk');
        $latestHitungHargaJual = DB::table('hitung_harga_jual')
                        ->where('user_id', $user_id)
                        ->latest('updated_at')
                        ->first();
        $jumlahProduk = $latestHitungHargaJual ? $latestHitungHargaJual->jumlah_produk : null;
        $hargaJual = $latestHitungHargaJual ? $latestHitungHargaJual->harga_jual : null;

        $latestBiayaProduksi = DB::table('hitung_biaya_produksi')
                        ->where('user_id', $user_id)
                        ->latest('updated_at')
                        ->first();
        $biayaProduksi = $latestBiayaProduksi ? $latestBiayaProduksi->biaya_produksi : null;

        $latestPerkiraanPenjualan = DB::table('hitung_perkiraan_penjualan')
                        ->where('user_id', $user_id)
                        ->latest('updated_at')
                        ->first();
        $perkiraanPenjualan = $latestPerkiraanPenjualan ? $latestPerkiraanPenjualan->perkiraan_penjualan : null;

        $latestHPP = DB::table('hitung_hpp')
                        ->where('user_id', $user_id)
                        ->latest('updated_at')
                        ->first();
        $hpp = $latestHPP ? $latestHPP->hpp : null;


        return view('seller.hitung', compact('totalBiaya','jumlahProduk','totalBiayaTetap','hargaJual','BVunit','biayaProduksi', 'perkiraanPenjualan','hpp'));
    }

    public function dataHitung()
    {
        $user_id = Auth::id();

        $variabel = HitungBiayaVariabel::latest()->get();
        $tetap = HitungBiayaTetap::latest()->get();
        $totalBiayaVariabel = DB::table('hitung_biaya_variabel')
                ->where('user_id', $user_id)
                ->sum('total_biaya');
        $totalBiayaTetap = DB::table('hitung_biaya_tetap')
                ->where('user_id', $user_id)
                ->sum('total_biaya');

        $AmbilHargaJual = DB::table('hitung_harga_jual')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $hargaJual = $AmbilHargaJual ? $AmbilHargaJual->harga_jual : null;

        $AmbilHPP = DB::table('hitung_hpp')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $hpp = $AmbilHPP ? $AmbilHPP->hpp : null;

        $AmbilBEPUnit = DB::table('hitung_bep')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $bepUnit = $AmbilBEPUnit ? $AmbilBEPUnit->bep : null;

        $AmbilBEPRupiah = DB::table('hitung_bep_rupiah')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $bepRupiah = $AmbilBEPRupiah ? $AmbilBEPRupiah->bep_rupiah : null;

        $AmbilPerkiraanPenjulan = DB::table('hitung_perkiraan_penjualan')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $perkiraanPenjualan = $AmbilPerkiraanPenjulan ? $AmbilPerkiraanPenjulan->perkiraan_penjualan : null;

        $AmbilBiayaProduksi = DB::table('hitung_biaya_produksi')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $biayaProduksi = $AmbilBiayaProduksi ? $AmbilBiayaProduksi->biaya_produksi : null;

        $AmbilLabaUsaha = DB::table('hitung_laba_usaha')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $labaUsaha = $AmbilLabaUsaha ? $AmbilLabaUsaha->laba_usaha : null;

        $AmbilLabaKotor = DB::table('hitung_laba_kotor')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $labaKotor = $AmbilLabaKotor ? $AmbilLabaKotor->laba_kotor : null;

        $AmbilBCRatio = DB::table('hitung_bc_ratio')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $BCRatio = $AmbilBCRatio ? $AmbilBCRatio->bc_ratio : null;

        $AmbilGrosProfitMargin = DB::table('hitung_gros_profit_margin')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $grosProfitMargin = $AmbilGrosProfitMargin ? $AmbilGrosProfitMargin->gros_profit_margin : null;

        $AmbilNetProfitMargin = DB::table('hitung_net_profit_margin')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $netProfitMargin = $AmbilNetProfitMargin ? $AmbilNetProfitMargin->net_profit_margin : null;

        return view('seller.tampilan_hitung', compact(
            'variabel','tetap',
            'totalBiayaVariabel','totalBiayaTetap','hargaJual','hpp', 'bepUnit', 'bepRupiah', 'perkiraanPenjualan',
            'biayaProduksi', 'labaUsaha', 'labaKotor', 'BCRatio', 'netProfitMargin', 'grosProfitMargin'
        ));
    }

    public function downloadPdf()
    {
        $user_id = Auth::id();

        $variabel = HitungBiayaVariabel::latest()->get();
        $tetap = HitungBiayaTetap::latest()->get();
        $totalBiayaVariabel = DB::table('hitung_biaya_variabel')
                ->where('user_id', $user_id)
                ->sum('total_biaya');
        $totalBiayaTetap = DB::table('hitung_biaya_tetap')
                ->where('user_id', $user_id)
                ->sum('total_biaya');

        $AmbilHargaJual = DB::table('hitung_harga_jual')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $hargaJual = $AmbilHargaJual ? $AmbilHargaJual->harga_jual : null;

        $AmbilHPP = DB::table('hitung_hpp')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $hpp = $AmbilHPP ? $AmbilHPP->hpp : null;

        $AmbilBEPUnit = DB::table('hitung_bep')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $bepUnit = $AmbilBEPUnit ? $AmbilBEPUnit->bep : null;

        $AmbilBEPRupiah = DB::table('hitung_bep_rupiah')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $bepRupiah = $AmbilBEPRupiah ? $AmbilBEPRupiah->bep_rupiah : null;

        $AmbilPerkiraanPenjulan = DB::table('hitung_perkiraan_penjualan')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $perkiraanPenjualan = $AmbilPerkiraanPenjulan ? $AmbilPerkiraanPenjulan->perkiraan_penjualan : null;

        $AmbilBiayaProduksi = DB::table('hitung_biaya_produksi')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $biayaProduksi = $AmbilBiayaProduksi ? $AmbilBiayaProduksi->biaya_produksi : null;

        $AmbilLabaUsaha = DB::table('hitung_laba_usaha')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $labaUsaha = $AmbilLabaUsaha ? $AmbilLabaUsaha->laba_usaha : null;

        $AmbilLabaKotor = DB::table('hitung_laba_kotor')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $labaKotor = $AmbilLabaKotor ? $AmbilLabaKotor->laba_kotor : null;

        $AmbilBCRatio = DB::table('hitung_bc_ratio')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $BCRatio = $AmbilBCRatio ? $AmbilBCRatio->bc_ratio : null;

        $AmbilGrosProfitMargin = DB::table('hitung_gros_profit_margin')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $grosProfitMargin = $AmbilGrosProfitMargin ? $AmbilGrosProfitMargin->gros_profit_margin : null;

        $AmbilNetProfitMargin = DB::table('hitung_net_profit_margin')
                ->where('user_id', $user_id)
                ->latest('updated_at')
                ->first();
        $netProfitMargin = $AmbilNetProfitMargin ? $AmbilNetProfitMargin->net_profit_margin : null;

        // Menggunakan Dompdf untuk menghasilkan PDF
        $dompdf = new Dompdf();
        $html = view('seller.pdf', compact(
            'variabel','tetap',
            'totalBiayaVariabel','totalBiayaTetap','hargaJual','hpp', 'bepUnit', 'bepRupiah', 'perkiraanPenjualan',
            'biayaProduksi', 'labaUsaha', 'labaKotor', 'BCRatio', 'netProfitMargin', 'grosProfitMargin'
        ))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = 'wesada_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $dompdf->stream($filename);
    }

    public function hargaJualStore(Request $request)
    {
        $request->validate([
            'total_biaya_variabel' => 'required|numeric|min:0',
            'jumlah_produk' => 'required|integer|min:1',
            'presentase' => 'required|integer|min:0',
        ]);

        $total_biaya_variabel = $request->total_biaya_variabel;
        $jumlah_produk = $request->jumlah_produk;
        $presentase = $request->presentase;

        $biaya_variabel_unit = $total_biaya_variabel / $jumlah_produk;

        $harga_jual = $biaya_variabel_unit + ($biaya_variabel_unit * $presentase / 100);

        HitungHargaJual::create([
            'total_biaya_variabel' => $total_biaya_variabel,
            'jumlah_produk' => $jumlah_produk,
            'biaya_variabel_unit' => $biaya_variabel_unit,
            'presentase' => $presentase,
            'harga_jual' => $harga_jual,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('seller.hitung')->with('success', 'Perhitungan harga jual berhasil disimpan.');
    }

    public function hppStore(Request $request)
    {
        $request->validate([
            'persediaan_awal' => 'required|numeric|min:0',
            'persediaan_akhir' => 'required|numeric|min:0',
            'total_biaya_variabel' => 'required|numeric|min:0',
            'jumlah_produk' => 'required|integer|min:1',
        ]);

        // Hitung Harga Pokok Penjualan (HPP) dan HPP per unit
        $persediaanAwal = $request->input('persediaan_awal');
        $persediaanAkhir = $request->input('persediaan_akhir');
        $totalBiayaVariabel = $request->input('total_biaya_variabel');
        $jumlahProduk = $request->input('jumlah_produk');
        
        $hpp = $persediaanAwal + $totalBiayaVariabel - $persediaanAkhir;
        $hppUnit = $jumlahProduk > 0 ? $hpp / $jumlahProduk : 0;

        // Simpan ke database
        $hppRecord = new HitungHpp();
        $hppRecord->persediaan_awal = $persediaanAwal;
        $hppRecord->persediaan_akhir = $persediaanAkhir;
        $hppRecord->total_biaya_variabel = $totalBiayaVariabel;
        $hppRecord->hpp = $hpp;
        $hppRecord->jumlah_produk = $jumlahProduk;
        $hppRecord->hpp_unit = $hppUnit;
        $hppRecord->user_id = Auth::id(); // Dapatkan ID pengguna yang sedang login
        $hppRecord->save();

        return redirect()->route('seller.hitung')->with('success', 'Data HPP berhasil disimpan.');
    }

    public function bepUnitStore(Request $request)
    {
        $validatedData = $request->validate([
            'total_biaya_tetap' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'biaya_variabel_unit' => 'required|numeric',
            'bep' => 'required|numeric'
        ]);

        $validatedData['user_id'] = Auth::id();

        HitungBEP::create($validatedData);

        return redirect()->back()->with('success', 'Data BEP Unit berhasil disimpan.');
    }

    public function bepRupiahStore(Request $request)
    {
        $validatedData = $request->validate([
            'total_biaya_tetap' => 'required|numeric',
            'biaya_variabel_unit' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        $totalBiayaTetap = $validatedData['total_biaya_tetap'];
        $biayaVariabelUnit = $validatedData['biaya_variabel_unit'];
        $hargaJual = $validatedData['harga_jual'];

        if ($hargaJual > 0 && $hargaJual > $biayaVariabelUnit) {
            $bepRupiah = $totalBiayaTetap / (1 - ($biayaVariabelUnit / $hargaJual));
            $validatedData['bep_rupiah'] = $bepRupiah; // Menyimpan hasil perhitungan ke validatedData
        } else {
            return redirect()->back()->withErrors(['harga_jual' => 'Harga jual harus lebih besar dari biaya variabel.']);
        }

        $validatedData['user_id'] = Auth::id();

        HitungBEPRupiah::create($validatedData);

        return redirect()->back()->with('success', 'Data BEP Rupiah berhasil disimpan.');
    }

    public function perkiraanPenjualan(Request $request)
    {
        $request->validate([
            'harga_jual' => 'required|numeric',
            'jumlah_produk' => 'required|integer|min:1',
            'perkiraan_penjualan' => 'required|numeric',
        ]);

        HitungPerkiraanPenjualan::create([
            'harga_jual' => $request->harga_jual,
            'jumlah_produk' => $request->jumlah_produk,
            'perkiraan_penjualan' => $request->perkiraan_penjualan,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Perkiraan penjualan berhasil disimpan.');
    }

    public function biayaProduksi(Request $request)
    {
        $validatedData = $request->validate([
            'persediaan_awal' => 'required|numeric|min:0',
            'persediaan_akhir' => 'required|numeric|min:0',
            'total_biaya_variabel' => 'required|numeric|min:0',
        ]);

        $biayaProduksi = $validatedData['persediaan_awal'] + $validatedData['total_biaya_variabel'] - $validatedData['persediaan_akhir'];

        HitungBiayaProduksi::create([
            'persediaan_awal' => $validatedData['persediaan_awal'],
            'persediaan_akhir' => $validatedData['persediaan_akhir'],
            'total_biaya_variabel' => $validatedData['total_biaya_variabel'],
            'biaya_produksi' => $biayaProduksi,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Data biaya produksi berhasil disimpan.'); // Ganti dengan rute yang sesuai
    }

    public function labaUsaha(Request $request)
    {
        $request->validate([
            'perkiraan_penjualan' => 'required|numeric',
            'biaya_produksi' => 'required|numeric',
        ]);

        // Hitung laba bersih
        $perkiraanPenjualan = $request->perkiraan_penjualan;
        $biayaProduksi = $request->biaya_produksi;
        $labaBersih = $perkiraanPenjualan - $biayaProduksi;

        // Simpan data ke database
        HitungLabaUsaha::create([
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'biaya_produksi' => $biayaProduksi,
            'laba_usaha' => $labaBersih,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Laba usaha berhasil disimpan.');
    }
    
    public function labaKotor(Request $request)
    {
        $request->validate([
            'perkiraan_penjualan' => 'required|numeric',
            'hpp' => 'required|numeric',
        ]);

        $perkiraanPenjualan = $request->perkiraan_penjualan;
        $hpp = $request->hpp;
        $labaKotor = $perkiraanPenjualan - $hpp;

        HitungLabaKotor::create([
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'hpp' => $hpp,
            'laba_kotor' => $labaKotor,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Laba kotor berhasil disimpan.');
    }

    public function bcRatio(Request $request)
    {
        $request->validate([
            'perkiraan_penjualan' => 'required|numeric',
            'biaya_produksi' => 'required|numeric',
        ]);

        $perkiraanPenjualan = $request->perkiraan_penjualan;
        $biayaProduksi = $request->biaya_produksi;
        $bcRatio = $biayaProduksi != 0 ? $perkiraanPenjualan / $biayaProduksi : 0;

        HitungBcRatio::create([
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'biaya_produksi' => $biayaProduksi,
            'bc_ratio' => $bcRatio,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'BC Ratio berhasil disimpan.');
    }

    public function netProfit(Request $request)
    {
        // Validasi input
        $request->validate([
            'laba_kotor' => 'required|numeric',
            'perkiraan_penjualan' => 'required|numeric',
        ]);

        // Hitung Gross Profit Margin
        $labaKotor = $request->laba_kotor;
        $perkiraanPenjualan = $request->perkiraan_penjualan;
        $grosProfitMargin = $perkiraanPenjualan != 0 ? ($labaKotor / $perkiraanPenjualan) * 100 : 0;

        // Simpan data ke database
        HitungGrosProfitMargin::create([
            'laba_kotor' => $labaKotor,
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'gros_profit_margin' => $grosProfitMargin,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Gross Profit Margin berhasil disimpan.');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'laba_usaha' => 'required|numeric',
            'perkiraan_penjualan' => 'required|numeric',
        ]);

        // Hitung Net Profit Margin
        $labaUsaha = $request->laba_usaha;
        $perkiraanPenjualan = $request->perkiraan_penjualan;
        $netProfitMargin = $perkiraanPenjualan != 0 ? ($labaUsaha / $perkiraanPenjualan) * 100 : 0;

        // Simpan data ke database
        HitungNetProfitMargin::create([
            'laba_usaha' => $labaUsaha,
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'net_profit_margin' => $netProfitMargin,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Net Profit Margin berhasil disimpan.');
    }

    public function calculateAndStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'perkiraan_penjualan' => 'required|numeric',
            'biaya_produksi' => 'required|numeric',
            'hpp' => 'required|numeric',
            'laba_kotor' => 'required|numeric',
            'laba_usaha' => 'required|numeric',
        ]);
        // dd($request->all());


        // Ambil data dari form
        $perkiraanPenjualan = $request->perkiraan_penjualan;
        $biayaProduksi = $request->biaya_produksi;
        $hpp = $request->hpp;
        $labaKotor = $request->laba_kotor;
        $labaUsaha = $request->laba_usaha;
        

        // 1. Hitung Laba Usaha
        $labaBersih = $perkiraanPenjualan - $biayaProduksi;
        HitungLabaUsaha::create([
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'biaya_produksi' => $biayaProduksi,
            'laba_usaha' => $labaBersih,
            'user_id' => Auth::id(),
        ]);

        // 2. Hitung Laba Kotor
        $labaKotor = $perkiraanPenjualan - $hpp;
        HitungLabaKotor::create([
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'hpp' => $hpp,
            'laba_kotor' => $labaKotor,
            'user_id' => Auth::id(),
        ]);

        // 3. Hitung BC Ratio
        $bcRatio = $biayaProduksi != 0 ? $perkiraanPenjualan / $biayaProduksi : 0;
        HitungBcRatio::create([
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'biaya_produksi' => $biayaProduksi,
            'bc_ratio' => $bcRatio,
            'user_id' => Auth::id(),
        ]);

        // 4. Hitung Gross Profit Margin
        $grosProfitMargin = $perkiraanPenjualan != 0 ? ($labaKotor / $perkiraanPenjualan) * 100 : 0;
        HitungGrosProfitMargin::create([
            'laba_kotor' => $labaKotor,
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'gros_profit_margin' => $grosProfitMargin,
            'user_id' => Auth::id(),
        ]);

        // 5. Hitung Net Profit Margin
        $netProfitMargin = $perkiraanPenjualan != 0 ? ($labaUsaha / $perkiraanPenjualan) * 100 : 0;
        HitungNetProfitMargin::create([
            'laba_usaha' => $labaUsaha,
            'perkiraan_penjualan' => $perkiraanPenjualan,
            'net_profit_margin' => $netProfitMargin,
            'user_id' => Auth::id(),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Semua berhasil disimpan.');
    }

}
