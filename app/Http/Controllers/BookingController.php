<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = DB::table('tbl_booking')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->join('tbl_kamar', 'tbl_booking.kamar_id', '=', 'tbl_kamar.id')
            ->select(
                'tbl_booking.*',
                'users.name AS nama_customer',
                'tbl_kamar.nomor AS nomor_kamar',
                'tbl_kamar.lantai',
            )
            ->get();

        return view('pages.booking.index', compact('booking'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function customerBooking()
    {
        $query = DB::table('users')->where('id', Auth::user()->id)->first();

        $booking = DB::table('tbl_booking')->where('customer_id', $query->id)->get();

        return view('pages.booking.customerlist', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'uploadBukti' => 'required|image|mimes:png,jpg,jpeg,jfif',
            'kamarID' => 'required|exists:tbl_kamar,id',
        ]);

        $kamar = DB::table('tbl_kamar')->where('id', $request->kamarID)->first();

        $imageName = null;
        if ($request->hasFile('uploadBukti')) {
            $imageName = time() . '_' . $request->file('uploadBukti')->getClientOriginalName();
            $request->file('uploadBukti')->storeAs('upload/bukti', $imageName, 'public');
        }

        DB::table('tbl_booking')->insert([
            'customer_id' => Auth::user()->id,
            'kamar_id' => $request->kamarID,
            'harga_kamar_booking' => $kamar->harga,
            'bukti_bayar' => $imageName,
            'status' => 'Menunggu',
            'created_at' => now(),
            'updated_ta' => now(),
        ]);

        return redirect('booking')->withSuccess('Anda berhasil melakukan booking!');
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
        //
    }
}
