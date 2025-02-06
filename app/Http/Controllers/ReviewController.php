<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index()
    {
        $data = DB::table('reviews')
            ->join('tbl_kamar', 'reviews.kamar_id', '=', 'tbl_kamar.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'tbl_kamar.nomor as nomor_kamar', 'users.name as user_name')
            ->get();

        return view('pages.rating.index', compact('data'));
    }

    /**
     * Toggle the status of the review.
     */
    public function toggleStatus($id)
    {
        $review = DB::table('reviews')->where('id', $id)->first();
        $newStatus = $review->status === 'active' ? 'deactive' : 'active';

        DB::table('reviews')->where('id', $id)->update(['status' => $newStatus]);

        return redirect()->route('rating.index')->with('status', 'Review status updated successfully.');
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
     * Update the specified review in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:255',
        ]);

        DB::table('reviews')->where('id', $id)->update([
            'rating' => $request->rating,
            'review' => $request->review,
            'updated_at' => now(),
        ]);

        return redirect()->route('rating.index')->with('status', 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        DB::table('reviews')->where('id', $id)->delete();
        return redirect()->route('rating.index')->with('status', 'Review deleted successfully.');
    }
}
