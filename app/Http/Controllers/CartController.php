<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
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

        return view('userSide.cart', compact('cartItems', 'productsCount'));
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

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'تم تحديث الكمية بنجاح']);
        }

        return redirect()->back()->with('success', 'تم تحديث الكمية');
    }

    public function checkout()
    {
        try {
            // Get cart items
            $cartItems = CartItem::where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty'
                ]);
            }

            // Calculate total
            $total = $cartItems->sum(function($item) {
                return $item->quantity * $item->product->price;
            }) + 10; // Adding shipping cost

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pending'
            ]);

            // Clear cart
            CartItem::where('user_id', Auth::id())->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'redirect' => route('orders.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your order.'
            ], 500);
        }
    }
}
