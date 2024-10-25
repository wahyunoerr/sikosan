<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('tbl_kamar')
            ->join('tbl_upload_file_image', 'tbl_kamar.id', '=', 'tbl_upload_file_image.kamar_id')
            ->select('tbl_kamar.*', 'tbl_upload_file_image.nameImage');

        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('tbl_kamar.nomor', 'like', '%' . $searchTerm . '%')
                    ->orWhere('tbl_kamar.lantai', 'like', '%' . $searchTerm . '%')
                    ->orWhere('tbl_kamar.fasilitas', 'like', '%' . $searchTerm . '%');
            });
        }

        $kamar = $query->get()->groupBy('id');

        return view('welcome', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function getItemKamar(string $id)
    {
        $kamar = DB::table('tbl_kamar')->where('id', $id)->first();
        $images = DB::table('tbl_upload_file_image')
            ->where('kamar_id', $id)
            ->get();

        $rekening = DB::table('tbl_rekening')->get();

        return view('checkout', compact('kamar', 'images', 'rekening'));
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
