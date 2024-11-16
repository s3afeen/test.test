<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('product.productImages')
            ->get();

        return view('userSide.wishlist', compact('wishlistItems'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $message = 'تم إزالة المنتج من المفضلة';
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ]);
            $message = 'تمت إضافة المنتج إلى المفضلة';
            $status = 'added';
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'status' => $status
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
