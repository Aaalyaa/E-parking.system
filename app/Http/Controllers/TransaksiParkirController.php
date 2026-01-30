<?php

namespace App\Http\Controllers;

use App\Models\TransaksiParkir;
use App\Models\Tarif;
use App\Models\DataKendaraan;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Helpers\LogAktivitas;

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

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $dataKendaraan = DataKendaraan::with('tipe_kendaraan')->get();
        $areas = Area::with('lokasiArea')->get();
        $parkirAktif = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_IN)->get();

        return view('transaksi.create', compact('dataKendaraan', 'areas', 'parkirAktif'));
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'id_data_kendaraan' => 'required',
            'id_area' => 'required',
        ]);

        $cek = TransaksiParkir::where('id_data_kendaraan', $request->id_data_kendaraan)
            ->where('status_parkir', TransaksiParkir::STATUS_IN)
            ->exists();

        if ($cek) {
            return back()->with('error', 'Kendaraan masih parkir!');
        }

        $dataKendaraan = DataKendaraan::with('tipe_kendaraan')
            ->findOrFail($request->id_data_kendaraan);

        $idTipeKendaraan = $dataKendaraan->id_tipe_kendaraan;

        $area = Area::findOrFail($request->id_area);

        if ($area->slotTersedia($idTipeKendaraan) <= 0) {
            return back()->with('error', 'Slot parkir penuh untuk tipe kendaraan ini!');
        }

        TransaksiParkir::create([
            'kode' => TransaksiParkir::generateNomorStruk(),
            'id_data_kendaraan' => $request->id_data_kendaraan,
            'id_area' => $request->id_area,
            'waktu_masuk' => now(),
            'status_parkir' => TransaksiParkir::STATUS_IN,
        ]);

        LogAktivitas::add(
            'TRANSAKSI_MASUK',
            'Kendaraan ' . $dataKendaraan->plat_nomor . ' masuk area ' . $area->nama_area,
            'transaksi_parkir',
            null
        );

        return back()->with('success', 'Kendaraan masuk dicatat');
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

        $waktuKeluar = now();
        $durasiMenit = $transaksi->waktu_masuk->diffInMinutes($waktuKeluar);
        $durasiJam = ceil($durasiMenit / 60);

        $tarif = Tarif::where('id_tipe_kendaraan', $transaksi->dataKendaraan->id_tipe_kendaraan)
            ->where('durasi_minimal', '<=', $durasiJam)
            ->where('durasi_maksimal', '>=', $durasiJam)
            ->first();

        if (!$tarif) {
            return back()->with('error', 'Tarif tidak ditemukan!');
        }

        $total = $tarif->harga;
        $diskonNominal = 0;
        $member = $transaksi->dataKendaraan->memberAktif;
        if ($member) {
            $tipeMember = $member->tipe_member;

            if ($tipeMember && $tipeMember->diskon_persen > 0) {
                $diskonNominal = ($tipeMember->diskon_persen / 100) * $total;
            }
        }

        $bayarAkhir = max(0, $total - $diskonNominal);

        $transaksi->update([
            'id_tarif' => $tarif->id,
            'waktu_keluar' => $waktuKeluar,
            'durasi_parkir' => $durasiJam,
            'diskon_nominal' => $diskonNominal,
            'total_biaya' => $bayarAkhir,
            'status_parkir' => TransaksiParkir::STATUS_OUT,
            'metode_bayar' => $request->metode_bayar,
        ]);

        LogAktivitas::add(
            'TRANSAKSI_KELUAR',
            'Kendaraan ' . $transaksi->dataKendaraan->plat_nomor .
                ' keluar, total Rp ' . number_format($bayarAkhir, 0, ',', '.'),
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
