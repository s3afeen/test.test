<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        // التحقق من أن المستخدم قد اشترى المنتج
        $hasPurchased = Order::where('user_id', Auth::id())
            ->whereHas('orderItems', function($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })
            ->where('status', 'completed')
            ->exists();

        if (!$hasPurchased) {
            return response()->json([
                'error' => 'يمكن فقط للمستخدمين الذين اشتروا المنتج إضافة تقييم'
            ], 403);
        }

        $rating = Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        return response()->json(['message' => 'تم إضافة التقييم بنجاح', 'rating' => $rating]);
    }
}
