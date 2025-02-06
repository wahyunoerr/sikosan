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
            ->leftJoin('tbl_booking', function ($join) {
                $join->on('tbl_kamar.id', '=', 'tbl_booking.kamar_id')
                    ->where('tbl_booking.status', '=', 'Menunggu')
                    ->where('tbl_booking.customer_id', '=', auth()->id());
            })
            ->select('tbl_kamar.*', 'tbl_upload_file_image.nameImage', 'tbl_booking.customer_id as booked_by_user', 'tbl_booking.status as booking_status');

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

        $reviews = DB::table('reviews')
            ->where('kamar_id', $id)
            ->get();

        $totalStars = DB::table('reviews')->sum('rating');
        $totalReviews = DB::table('reviews')->where('kamar_id', $id)->count();

        $averageRating = $totalReviews > 0 ? $totalStars / $totalReviews : 0;
        $requiredReviewsForFiveStar = max(500, ceil(($totalReviews * 5 - $totalStars) / (5 - $averageRating)));

        $userHasRated = $reviews->where('user_id', auth()->id())->isNotEmpty();

        $kamar = (array) $kamar;
        $kamar['reviews'] = $reviews;

        $kamar = (object) $kamar;

        return view('checkout', compact('kamar', 'images', 'rekening', 'reviews', 'averageRating', 'totalStars', 'totalReviews', 'requiredReviewsForFiveStar', 'userHasRated'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function storeReview(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:tbl_kamar,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        DB::table('reviews')->insert([
            'kamar_id' => $request->kamar_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('status', 'Review submitted successfully.');
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
