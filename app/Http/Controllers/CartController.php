<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product.productImages')
            ->get();
            $productsCount = Product::count();

        return view('userSide.cart', compact('cartItems' ,'productsCount'));
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
        // التحقق من الكمية المدخلة
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // تحديث الكمية في قاعدة البيانات
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;  // تعيين الكمية الجديدة
            $cartItem->save();  // حفظ التغييرات
        }

        // التحقق إذا كان الطلب من نوع AJAX
        if ($request->ajax()) {
            return response()->json(['message' => 'تم تحديث الكمية بنجاح']);
        }

        // إعادة توجيه المستخدم مع رسالة نجاح
        return redirect()->back()->with('success', 'تم تحديث الكمية');
    }



}
