<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product.productImages')
            ->get();

        return view('userSide.cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ],
            [
                'quantity' => $request->quantity
            ]
        );

        if ($request->ajax()) {
            return response()->json([
                'message' => 'تمت إضافة المنتج إلى السلة',
                'cartItem' => $cartItem
            ]);
        }

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    public function remove($id)
    {
        CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'تم حذف المنتج من السلة']);
        }

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->update(['quantity' => $request->quantity]);

        if ($request->ajax()) {
            return response()->json(['message' => 'تم تحديث الكمية']);
        }

        return redirect()->back()->with('success', 'تم تحديث الكمية');
    }
}
