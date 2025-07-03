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

        $validateKamar = $request->validate([
            'nomorKamar' => 'required',
            'hargaKamar' => 'required',
            'lantaiKamar' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
            'status' => 'required|in:Sudah Dihuni,Belum Dihuni',
            'fasilitas' => 'required',
            'fotoKamar' => 'required|array',
            'fotoKamar.*' => 'required|mimes:jpg,jpeg,png,jfif',
            'alamat' => 'required',
        ]);

        $kamarId = DB::table('tbl_kamar')->insertGetId([
            'nomor'     => $validateKamar['nomorKamar'],
            'harga'     => $validateKamar['hargaKamar'],
            'lantai'    => $validateKamar['lantaiKamar'],
            'status'    => $validateKamar['status'],
            'fasilitas' => $validateKamar['fasilitas'],
            'alamat'    => $validateKamar['alamat'],
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

        $fotoKamar = DB::table('tbl_upload_file_image')
            ->where('kamar_id', $id)
            ->get();

        if (!$kamarId) {
            return redirect()->route('kamar.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('pages.kamar.edit', compact('kamarId', 'fotoKamar'));
    }

    public function update(Request $request, string $id)
    {
        $validateKamar = $request->validate([
            'nomorKamar' => 'required',
            'hargaKamar' => 'required',
            'lantaiKamar' => 'required|in:Lantai 1,Lantai 2,Lantai 3',
            'status' => 'required|in:Sudah Dihuni,Belum Dihuni',
            'fasilitas' => 'required',
            'fotoKamar' => 'array',
            'fotoKamar.*' => 'mimes:jpg,jpeg,png,jfif',
            'alamat' => 'required',
        ]);

        DB::table('tbl_kamar')->where('id', $id)->update([
            'nomor' => $validateKamar['nomorKamar'],
            'harga' => $validateKamar['hargaKamar'],
            'lantai' => $validateKamar['lantaiKamar'],
            'status' => $validateKamar['status'],
            'fasilitas' => $validateKamar['fasilitas'],
            'alamat' => $validateKamar['alamat'],
            'updated_at' => now(),
        ]);

        if ($request->hasFile('fotoKamar')) {
            $oldImages = DB::table('tbl_upload_file_image')->where('kamar_id', $id)->get();
            foreach ($oldImages as $oldImage) {
                Storage::disk('public')->delete('upload/image/' . $oldImage->nameImage);
            }
            DB::table('tbl_upload_file_image')->where('kamar_id', $id)->delete();

            foreach ($request->file('fotoKamar') as $file) {
                if ($file->isValid()) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('upload/image/', $imageName, 'public');

                    DB::table('tbl_upload_file_image')->insert([
                        'nameImage' => $imageName,
                        'kamar_id' => $id,
                    ]);
                }
            }
        }

        return redirect('/kamar')->with('success', 'Data kamar berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $images = DB::table('tbl_upload_file_image')
            ->where('kamar_id', $id)
            ->get();

        foreach ($images as $image) {
            Storage::disk('public')->delete('upload/image/' . $image->nameImage);
        }

        DB::table('tbl_upload_file_image')->where('kamar_id', $id)->delete();

        DB::table('tbl_kamar')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function riwayat()
    {
        $riwayat = DB::table('tbl_pindah')
            ->join('tbl_booking', 'tbl_pindah.booking_id', '=', 'tbl_booking.id')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->join('tbl_kamar as kamar_lama', 'tbl_pindah.kamar_lama_id', '=', 'kamar_lama.id')
            ->select(
                'tbl_pindah.*',
                'users.name as nama_customer',
                'kamar_lama.nomor as nomor_kamar_lama',
                'tbl_booking.customer_id',
                'tbl_booking.tanggal_booking',
                'kamar_lama.id as kamar_id',
                'kamar_lama.lantai',
                'kamar_lama.status',
                'kamar_lama.fasilitas',
                'kamar_lama.alamat'
            )
            ->orderBy('tbl_pindah.tanggal_pindah', 'desc')
            ->get();
        // Data kamar indexed by id
        $dataKamar = DB::table('tbl_kamar')->get()->keyBy('id');
        // Gambar kamar indexed by kamar_id
        $gambarKamar = DB::table('tbl_upload_file_image')->get()->groupBy('kamar_id');
        return view('pages.kamar.riwayat_kamar', compact('riwayat', 'dataKamar', 'gambarKamar'));
    }


    public function laporanKosong()
    {
        $kamar_kosong = DB::table('tbl_kamar')
            ->where('status', 'Belum Dihuni')
            ->get();

        $histori = DB::table('tbl_pindah')
            ->join('tbl_booking', 'tbl_pindah.booking_id', '=', 'tbl_booking.id')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->join('tbl_kamar as kamar_lama', 'tbl_pindah.kamar_lama_id', '=', 'kamar_lama.id')
            ->select(
                'tbl_pindah.*',
                'users.name as nama_customer',
                'kamar_lama.nomor as nomor_kamar_lama',
                'tbl_booking.tanggal_booking',
                'tbl_pindah.tanggal_pindah'
            )
            ->whereIn('tbl_pindah.kamar_lama_id', $kamar_kosong->pluck('id'))
            ->orderBy('tbl_pindah.tanggal_pindah', 'desc')
            ->get()
            ->groupBy('kamar_lama_id');

        return view('pages.kamar.laporan_kosong', compact('kamar_kosong', 'histori'));
    }

    function listKamar()
    {
        $kamar = DB::table('tbl_kamar')->get();
        $gambarKamar = DB::table('tbl_upload_file_image')->get()->groupBy('kamar_id');
        $penghuniAktif = DB::table('tbl_booking')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->where('tbl_booking.status', 'Disetujui')
            ->select('tbl_booking.kamar_id', 'users.name as nama_customer')
            ->get()->keyBy('kamar_id');
        $riwayatPindah = DB::table('tbl_pindah')
            ->join('tbl_booking', 'tbl_pindah.booking_id', '=', 'tbl_booking.id')
            ->join('users', 'tbl_booking.customer_id', '=', 'users.id')
            ->select('tbl_pindah.kamar_lama_id', 'users.name as nama_customer', 'tbl_pindah.tanggal_pindah')
            ->orderByDesc('tbl_pindah.tanggal_pindah')
            ->get()->groupBy('kamar_lama_id');
        $bookingInfo = DB::table('tbl_booking')
            ->where('status', 'Disetujui')
            ->select('kamar_id', 'tanggal_booking')
            ->get()
            ->keyBy('kamar_id');
        return view('pages.kamar.listKamar', compact('kamar', 'gambarKamar', 'penghuniAktif', 'riwayatPindah', 'bookingInfo'));
    }
}
