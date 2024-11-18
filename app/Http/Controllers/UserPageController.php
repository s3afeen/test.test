<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                View::share('productsCount', Auth::user()->cartItems()->count());
            } else {
                View::share('productsCount', 0);
            }
            return $next($request);
        });
    }

    public function LandingPage()
    {
        $categories = Category::all();
        $products = Product::paginate(8);

        return view('userSide.landing', ['categories' => $categories , 'products' => $products]);
    }

    public function shop(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('price')) {
            $priceRanges = $request->price;
            $query->where(function ($query) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    [$min, $max] = explode('-', $range);
                    $query->orWhereBetween('price', [(float) $min, (float) $max]);
                }
            });
        }

        $products = $query->paginate(9);

        return view('userSide.shop', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function showProduct($id)
    {
        $product = Product::with('category', 'productImages')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $id)
                                  ->take(4)
                                  ->get();

        return view('userSide.productDetails', compact('product', 'relatedProducts'));
    }

    public function accountSettings()
    {
        $user = Auth::user();
        return view('userSide.accountSettings', compact('user'));
    }

    public function updateAccountSettings(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('account.settings')->with('success', 'Account settings updated successfully.');
    }
}
