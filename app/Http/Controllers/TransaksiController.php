<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = DB::table('tbl_transaksi')
            ->join('tbl_booking', 'tbl_transaksi.booking_id', '=', 'tbl_transaksi.id')
            ->select('tbl_transaksi.*', 'tbl_booking.*')
            ->get();
        return view('pages.transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request, string $id)
    {
        $booking = DB::table('tbl_booking')->where('id', $id)->first();

        if (!$booking) {
            return redirect()->back()->with('warning', 'Data booking tidak ditemukan!');
        }

        $action = $request->input('action');

        if ($action === 'setujui') {
            DB::table('tbl_transaksi')->insert([
                'booking_id' => $booking->id,
                'total_bayar' => $booking->harga_kamar_booking
            ]);

            DB::table('tbl_booking')->where('id', $id)->update([
                'status' => 'Disetujui'
            ]);

            DB::table('tbl_kamar')->where('id', $id)->update([
                'status' => 'Sudah Dihuni'
            ]);

            return redirect('/transaksi')->with('success', 'Transaksi berhasil dilakukan!');
        } elseif ($action === 'tolak') {
            DB::table('tbl_booking')->where('id', $id)->update([
                'status' => 'Ditolak'
            ]);

            return redirect()->back()->with('success', 'Booking ditolak!');
        } else {
            DB::table('tbl_booking')->where('id', $id)->update([
                'status' => 'Menunggu'
            ]);

            return redirect()->back()->with('success', 'Status booking diperbarui menjadi menunggu.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
