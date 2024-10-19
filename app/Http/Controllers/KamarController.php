<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('tbl_kamar')->get();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        return view('pages.kamar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validateKamar = $request->validate([
            'nomorKamar' => 'required',
            'hargaKamar' => 'required',
            'lantaiKamar' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
            'status' => 'required|in:Sudah Dihuni,Belum Dihuni',
            'fasilitas' => 'required',
            'fotoKamar' => 'required|array',
            'fotoKamar.*' => 'required|mimes:jpg,jpeg,png,jfif',
        ]);

        $kamarId = DB::table('tbl_kamar')->insertGetId([
            'nomor'     => $validateKamar['nomorKamar'],
            'harga'     => $validateKamar['hargaKamar'],
            'lantai'    => $validateKamar['lantaiKamar'],
            'status'    => $validateKamar['status'],
            'fasilitas' => $validateKamar['fasilitas'],
            'created_at' => now(),
            'updated_at' => now()
        ]);


        if ($request->hasFile('fotoKamar')) {
            foreach ($request->file('fotoKamar') as $file) {
                if ($file->isValid()) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('upload/image/', $imageName, 'public');

                    DB::table('tbl_upload_file_image')->insert([
                        'nameImage' => $imageName,
                        'kamar_id'  => $kamarId,
                    ]);
                }
            }
        }

        return redirect('kamar')->with('success', 'Data kamar berhasil ditambahkan');
    }

    function showImage(string $id)
    {
        $kamar = DB::table('tbl_kamar')->where('id', $id)->first();

        $imageId = DB::table('tbl_upload_file_image')->where('kamar_id', $kamar->id)->get();

        return view('pages.kamar.lihatFotoKamar', compact('imageId'));
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
        $kamarId = DB::table('tbl_kamar')->where('id', $id)->first();
        return view('pages.kamar.edit', compact('kamarId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validateKamar = $request->validate([
            'nomorKamar' => 'required',
            'hargaKamar' => 'required',
            'lantaiKamar' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
            'status' => 'required|in:Sudah Dihuni,Belum Dihuni',
            'fasilitas' => 'required',
            'fotoKamar' => 'required|array',
            'fotoKamar.*' => 'required|mimes:jpg,jpeg,png,jfif',
        ]);

        $kamarId = DB::table('tbl_kamar')->where('id', $id)->update([
            'nomor'     => $validateKamar['nomorKamar'],
            'harga'     => $validateKamar['hargaKamar'],
            'lantai'    => $validateKamar['lantaiKamar'],
            'status'    => $validateKamar['status'],
            'fasilitas' => $validateKamar['fasilitas'],
            'created_at' => now(),
            'updated_at' => now()
        ]);


        if ($request->hasFile('fotoKamar')) {
            foreach ($request->file('fotoKamar') as $file) {
                if ($file->isValid()) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('upload/image/', $imageName, 'public');

                    DB::table('tbl_upload_file_image')->where('id', $kamarId)->update([
                        'nameImage' => $imageName,
                        'kamar_id'  => $kamarId,
                    ]);
                }
            }
        }

        return redirect('kamar')->with('success', 'Data kamar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // $kamar = DB::table('tbl_kamar')->where('id', $id)->first();

        // $imageId = DB::table('tbl_upload_file_image')->where('kamar_id', $id)->get();
        // Storage::disk('public')->delete('upload/image/' . $imageId->nameImage);

        DB::table('tbl_kamar')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
