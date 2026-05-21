<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user','product'])->latest()->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved'=>!$review->is_approved]);
        return back()->with('success','Review status updated!');
    }
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success','Review deleted!');
    }
}
