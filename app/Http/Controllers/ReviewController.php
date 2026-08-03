<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'title'      => 'nullable|string|max:150',
            'review'     => 'nullable|string|max:1000',
        ]);

        $hasPurchased = Order::where('user_id', auth()->id())
            ->whereIn('status', ['Delivered', 'Completed'])
            ->whereHas('items', function($q) use ($request) {
                $q->where('product_id', $request->product_id);
            })
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Only verified customers who have purchased and received this product can write a review.');
        }

        Review::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'product_id' => $request->product_id,
            ],
            [
                'rating' => $request->rating,
                'title'  => $request->title,
                'review' => $request->review,
            ]
        );

        return back()->with('success', 'Your review has been submitted successfully.');
    }

    public function adminIndex()
    {
        $reviews = Review::with(['user', 'product'])->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }

    public function userDestroy($id)
    {
        $review = Review::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $review->delete();
        return back()->with('success', 'Your review has been deleted.');
    }
}

