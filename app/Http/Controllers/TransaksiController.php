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
            ->join('tbl_booking', 'tbl_transaksi.booking_id', '=', 'tbl_booking.id')
            ->leftJoin('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->select('tbl_transaksi.*', 'tbl_booking.*', 'users.name AS nama_pelanggan')
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
            DB::table('tbl_booking')->where('id', $id)->update([
                'status' => 'Disetujui'
            ]);
            DB::table('tbl_kamar')->where('id', $booking->kamar_id)->update([
                'status' => 'Sudah Dihuni'
            ]);
            return redirect('/transaksi')->with('success', 'Status booking berhasil disetujui!');
        } elseif ($action === 'tolak') {
            DB::table('tbl_booking')->where('id', $id)->update([
                'status' => 'Ditolak'
            ]);
            return redirect()->back()->with('success', 'Booking ditolak!');
        } elseif ($action === 'transaksi') {
            if ($booking->is_paid == 1) {
                DB::table('tbl_transaksi')->insert([
                    'booking_id' => $booking->id,
                    'total_bayar' => $booking->harga_kamar_booking,
                    'created_at' => now(),
                ]);
                return redirect('/transaksi')->with('success', 'Transaksi berhasil dilakukan!');
            } else {
                return redirect()->back()->with('warning', 'Transaksi hanya bisa dilakukan jika pembayaran sudah lunas!');
            }
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
    public function invoice(string $id)
    {
        $invoice = DB::table('tbl_transaksi')
            ->join('tbl_booking', 'tbl_transaksi.booking_id', '=', 'tbl_booking.id')
            ->leftJoin('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->leftJoin('tbl_kamar', 'tbl_booking.kamar_id', '=', 'tbl_kamar.id')
            ->select('tbl_transaksi.*', 'tbl_booking.status AS status_booking', 'tbl_booking.bukti_dp', 'users.name AS nama_pelanggan', 'users.email', 'tbl_kamar.*')
            ->where('tbl_transaksi.id', $id)
            ->first();

        return view('pages.transaksi.invoice', compact('invoice'));
    }
}
