<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        // جلب جميع المنتجات مع الصور
        $products = Product::with('productImages')->get();
        $productsCount = Product::count();

        return view('products.index', compact('products' ,'productsCount'));
    }

    public function create()
{
    $categories = Category::all(); // جلب جميع الفئات
    return view('products.create', compact('categories'));
}


    public function store(Request $request)
{
    // التحقق من صحة البيانات المدخلة
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image_path' => 'required|image', // التحقق من رفع الصورة
    ]);

    // إنشاء المنتج
    $product = Product::create($validatedData);

    // رفع الصورة وتخزينها في مجلد 'public/product_images'
    if ($request->hasFile('image_path')) {
        $imagePath = $request->file('image_path')->store('product_images', 'public');
        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $imagePath,
        ]);
    }

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
}


    public function edit($id)
    {
        $product = Product::with('productImages')->findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // تحقق من صحة البيانات
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image', // الصورة اختيارية في التعديل
        ]);

        // جلب المنتج المراد تعديله
        $product = Product::findOrFail($id);
        $product->update($validatedData);

        // في حالة رفع صورة جديدة
        if ($request->hasFile('image_path')) {
            // حذف الصورة القديمة
            if ($product->productImages()->exists()) {
                Storage::delete('public/' . $product->productImages->first()->image_path);
                $product->productImages()->delete(); // حذف السجل القديم
            }

            // رفع الصورة الجديدة
            $imagePath = $request->file('image_path')->store('product_images', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        // جلب المنتج المراد حذفه مع الصور
        $product = Product::findOrFail($id);

        // حذف الصور المرتبطة بالمنتج
        if ($product->productImages()->exists()) {
            Storage::delete('public/' . $product->productImages->first()->image_path);
            $product->productImages()->delete();
        }

        // حذف المنتج
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }



}
