<?php

namespace App\Http\Controllers;

use App\Models\TransaksiParkir;
use App\Models\TipeKendaraan;
use App\Models\DataKendaraan;
use App\Models\Area;
use App\Models\LokasiArea;
use Illuminate\Http\Request;
use App\Helpers\LogAktivitas;
use App\Helpers\HitungTarif;

class TransaksiParkirController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiParkir::with([
            'dataKendaraan',
            'area',
            'tarif'
        ])->where('status_parkir', TransaksiParkir::STATUS_OUT);

        if ($request->filled('tanggal')) {
            $query->whereDate('waktu_keluar', $request->tanggal);
        }

        if ($request->filled('plat')) {
            $query->whereHas('dataKendaraan', function ($q) use ($request) {
                $q->where('plat_nomor', 'like', '%' . $request->plat . '%');
            });
        }

        $transaksis = $query
            ->orderBy('waktu_keluar', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('transaksi.index', compact('transaksis'), [
            'canCreate' => auth()->user()->role->peran === 'petugas',
        ]);
    }

    public function createMasuk()
    {
        $tipeKendaraan = TipeKendaraan::all();
        $areas = Area::all();
        $lokasiAreas = LokasiArea::all();

        return view('transaksi.masuk.create', compact(
            'tipeKendaraan',
            'areas',
            'lokasiAreas'
        ));
    }

    public function createKeluar(Request $request)
    {
        $transaksi = null;
        $detailTarif = null;

        $kode = $request->query('kode');

        $listStruk = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_IN)
        ->orderBy('waktu_masuk', 'desc')
        ->get();

        if ($kode) {
            $transaksi = TransaksiParkir::with([
                'dataKendaraan.tipe_kendaraan',
                'dataKendaraan.memberAktif.tipe_member',
                'area.lokasiArea',
                'tipe_kendaraan'
            ])
                ->where('kode', $kode)
                ->where('status_parkir', TransaksiParkir::STATUS_IN)
                ->first();

            if ($transaksi) {
                $detailTarif = HitungTarif::from($transaksi);
            }
        }

        return view('transaksi.keluar.create', compact(
            'transaksi',
            'detailTarif',
            'listStruk'
        ));
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string',
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'id_area' => 'required|exists:area,id',
        ]);

        $dataKendaraan = DataKendaraan::where('plat_nomor', $request->plat_nomor)->first();
        $idDataKendaraan = $dataKendaraan?->id;

        $area = Area::findOrFail($request->id_area);

        if ($area->slotTersedia($request->id_tipe_kendaraan) <= 0) {
            return back()->with('error', 'Slot parkir penuh untuk tipe kendaraan ini!');
        }

        $transaksi = TransaksiParkir::create([
            'kode' => TransaksiParkir::generateNomorStruk(),
            'plat_nomor' => $request->plat_nomor,
            'id_tipe_kendaraan' => $request->id_tipe_kendaraan,
            'id_data_kendaraan' => $idDataKendaraan,
            'id_area' => $request->id_area,
            'waktu_masuk' => now(),
            'status_parkir' => TransaksiParkir::STATUS_IN,
        ]);

        LogAktivitas::add(
            'TRANSAKSI_MASUK',
            'Kendaraan ' . $request->plat_nomor . ' masuk area ' . $area->nama_area,
            'transaksi_parkir',
            $transaksi->id
        );

        return redirect()->route('transaksi.struk_masuk', $transaksi->id)
            ->with('success', 'Kendaraan masuk dicatat');
    }

    public function strukMasuk($id)
    {
        $transaksi = TransaksiParkir::with(['area', 'tipe_kendaraan'])
            ->findOrFail($id);

        if ($transaksi->status_parkir !== TransaksiParkir::STATUS_IN) {
            return back()->with('error', 'Struk masuk tidak valid!');
        }

        return view('transaksi.struk_masuk', compact('transaksi'));
    }


    public function storeKeluar(Request $request, $id)
    {
        $request->validate([
            'metode_bayar' => 'required|in:TUNAI,DEBIT,E-WALLET',
        ]);

        $transaksi = TransaksiParkir::findOrFail($id);

        if ($transaksi->status_parkir !== TransaksiParkir::STATUS_IN) {
            return back()->with('error', 'Transaksi tidak valid!');
        }

        $hasil = HitungTarif::from($transaksi);

        if (!$hasil) {
            return back()->with('error', 'Tarif parkir tidak ditemukan untuk durasi ini');
        }

        $transaksi->update([
            'id_tarif' => $hasil['id_tarif'],
            'waktu_keluar' => now(),
            'durasi_parkir' => $hasil['durasi_jam'],
            'diskon_nominal' => $hasil['diskon'],
            'total_biaya' => $hasil['total'],
            'status_parkir' => TransaksiParkir::STATUS_OUT,
            'metode_bayar' => $request->metode_bayar,
        ]);

        LogAktivitas::add(
            'TRANSAKSI_KELUAR',
            'Kendaraan ' . $transaksi->plat_nomor .
                ' keluar, total Rp ' . number_format($hasil['total'], 0, ',', '.'),
            'transaksi_parkir',
            $transaksi->id
        );

        return redirect()->route('transaksi.struk_keluar', $transaksi->id)
            ->with('success', 'Transaksi selesai');
    }

    public function strukKeluar($id)
    {
        $transaksi = TransaksiParkir::with(['dataKendaraan', 'area', 'tarif'])->findOrFail($id);

        if ($transaksi->status_parkir !== TransaksiParkir::STATUS_OUT) {
            return back()->with('error', 'Transaksi belum selesai!');
        }

        return view('transaksi.struk_keluar', compact('transaksi'));
    }
}
