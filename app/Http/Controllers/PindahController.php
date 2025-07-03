<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PindahController extends Controller
{
    public function index()
    {

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);
        $pindah = DB::table('tbl_pindah')
            ->join('tbl_booking', 'tbl_pindah.booking_id', '=', 'tbl_booking.id')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->join('tbl_kamar as kamar_lama', 'tbl_pindah.kamar_lama_id', '=', 'kamar_lama.id')
            ->select('tbl_pindah.*', 'kamar_lama.nomor as nomor_lama', 'tbl_booking.customer_id', 'users.name as customer_name')
            ->orderByDesc('tbl_pindah.tanggal_pindah')
            ->get();
        return view('pages.pindah.index', compact('pindah'));
    }

    public function create()
    {
        $booking = DB::table('tbl_booking')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->select('tbl_booking.*', 'users.name as customer_name')
            ->where('status', 'Disetujui')
            ->get();
        $kamar = DB::table('tbl_kamar')
            ->where('status', 'Sudah Dihuni')
            ->get();
        return view('pages.pindah.create', compact('booking', 'kamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:tbl_booking,id',
            'tanggal_pindah' => 'required|date',
            'alasan' => 'nullable|string',
        ]);
        $booking = DB::table('tbl_booking')->where('id', $request->booking_id)->where('status', 'Disetujui')->first();
        if (!$booking) {
            return redirect()->back()->with('error', 'Data booking tidak valid atau status bukan Disetujui!');
        }
        DB::table('tbl_pindah')->insert([
            'booking_id' => $request->booking_id,
            'kamar_lama_id' => $booking->kamar_id,
            'tanggal_pindah' => $request->tanggal_pindah,
            'alasan' => $request->alasan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('tbl_kamar')->where('id', $booking->kamar_id)->update(['status' => 'Belum Dihuni']);
        DB::table('tbl_booking')->where('id', $request->booking_id)->update(['status' => 'Selesai']);
        return redirect()->route('pindah.index')->with('success', 'Checkout/Pindah berhasil!');
    }

    public function destroy($id)
    {
        DB::table('tbl_pindah')->where('id', $id)->delete();
        return redirect()->route('pindah.index')->with('success', 'Data berhasil dihapus!');
    }
}
