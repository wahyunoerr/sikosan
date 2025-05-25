<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);
        $booking = DB::table('tbl_booking')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->join('tbl_kamar', 'tbl_booking.kamar_id', '=', 'tbl_kamar.id')
            ->select(
                'tbl_booking.*',
                'users.name AS nama_customer',
                'tbl_kamar.nomor AS nomor_kamar',
                'tbl_kamar.lantai'
            )
            ->get();

        return view('pages.booking.index', compact('booking'));
    }

    function statusBoking(Request $request, $id, $status)
    {
        $booking = DB::table('tbl_booking')->where('id', $id)->first();

        if ($status === 'Disetujui') {
            $kamarStatus = 'Sudah Dihuni';
            DB::table('tbl_booking')->where('id', $id)->update([
                'keterangan' => 'Booking diterima',
                'tanggal_booking' => now()
            ]);
            if ($booking->is_paid == 1) {
                DB::table('tbl_transaksi')->insert([
                    'booking_id' => $booking->id,
                    'total_bayar' => $booking->harga_kamar_booking,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($status === 'Ditolak') {
            $kamarStatus = 'Belum Dihuni';
            DB::table('tbl_booking')->where('id', $id)->update([
                'keterangan' => $request->input('reason')
            ]);
        } elseif ($status === 'Menunggu') {
            $kamarStatus = 'Belum Dihuni';
            DB::table('tbl_booking')->where('id', $id)->update([
                'keterangan' => '-'
            ]);
        } else {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        DB::table('tbl_booking')->where('id', $id)->update([
            'status' => $status
        ]);
        DB::table('tbl_kamar')->where('id', $booking->kamar_id)->update([
            'status' => $kamarStatus
        ]);

        return redirect('booking')->with('success', 'Status Berhasil Diubah');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function customerBooking()
    {
        $booking = DB::table('tbl_booking')
            ->where('customer_id', Auth::id())
            ->join('tbl_kamar', 'tbl_booking.kamar_id', '=', 'tbl_kamar.id')
            ->select('tbl_booking.*', 'tbl_kamar.nomor', 'tbl_kamar.lantai')
            ->get();

        return view('pages.booking.customerlist', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamarID' => 'required|exists:tbl_kamar,id',
            'bukti_dp' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $kamar = DB::table('tbl_kamar')->where('id', $request->kamarID)->first();

        $dp = $kamar->harga * 0.2;

        $buktiDpPath = $request->file('bukti_dp')->store('upload/bukti', 'public');

        $tanggalCheckin = $request->tanggal_checkin;
        $lamaSewa = date('Y-m-d', strtotime('+1 month -1 day', strtotime($tanggalCheckin)));

        DB::table('tbl_booking')->insert([
            'customer_id' => Auth::user()->id,
            'kamar_id' => $request->kamarID,
            'harga_kamar_booking' => $kamar->harga,
            'tanggal_booking' => now(),
            'tanggal_checkin' => $tanggalCheckin,
            'lama_sewa' => $tanggalCheckin . ' s/d ' . $lamaSewa,
            'dp' => $dp,
            'bukti_dp' => $buktiDpPath,
            'status' => 'Menunggu',
            'keterangan' => $request->keterangan,
            'is_paid' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('booking/customer')->withSuccess('Anda berhasil melakukan booking!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = DB::table('tbl_booking')->where('id', $id)->get();

        foreach ($image as $i) {
            Storage::disk('public')->delete('upload/bukti/' . $i->bukti_dp);
        }

        DB::table('tbl_booking')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function confirmPayment($id)
    {
        DB::table('tbl_booking')->where('id', $id)->update([
            'is_paid' => 1,
            'tanggal_checkin' => now(),
            'updated_at' => now(),
        ]);
        $booking = DB::table('tbl_booking')->where('id', $id)->first();
        $transaksiExists = DB::table('tbl_transaksi')->where('booking_id', $id)->exists();
        if (!$transaksiExists) {
            DB::table('tbl_transaksi')->insert([
                'booking_id' => $booking->id,
                'total_bayar' => $booking->harga_kamar_booking,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi!');
    }
}
