<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('tbl_rekening')->get();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        return view('pages.rekening.index', compact('data'));
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
        $validateRekening = $request->validate([
            'nomorRekening' => 'required',
            'namaRekening' => 'required'
        ]);

        DB::table('tbl_rekening')->insert([
            'namaRekening' => $validateRekening['namaRekening'],
            'nomorRekening' => $validateRekening['nomorRekening'],
        ]);

        return redirect('rekening')->with('succes', 'Data rekening berhasil ditambahkan');
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
        $rekeningId = DB::table('tbl_rekening')->where('id', $id)->first();

        return view('pages.rekening.edit', compact('rekeningId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateRekening = $request->validate([
            'nomorRekening' => 'required',
            'namaRekening' => 'required'
        ]);

        DB::table('tbl_rekening')->where('id', $id)->update([
            'namaRekening' => $validateRekening['namaRekening'],
            'nomorRekening' => $validateRekening['nomorRekening'],
        ]);

        return redirect('rekening')->with('success', 'Data rekening berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('tbl_rekening')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
