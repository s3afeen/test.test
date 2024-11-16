<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        // Get all Categories from the database
        $categories = Category::all();

        // Return view with Categories
        return view('categories.index', compact('categories'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // Return view to create a new category
        return view('categories.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Collect the input data
        $data = $request->all();

        // Check if there's an image in the request
        if ($request->hasFile('image')) {
            // Get the image file from the request
            $file = $request->file('image');

            // Generate a unique file name using the current time
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Use the Storage facade to store the image in the 'public' disk and save the path
            $path = $file->storeAs('public/uploads/categories', $filename); // The path will be stored as public/uploads/salon/filename

            // Save the relative path for the image to be stored in the 'image' column in the database
            $data['image'] = 'uploads/categories/' . $filename;
        }

        // Create the category in the database
        Category::create($data);

        // Redirect to the categories index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    // Display the specified resource.
    public function show(Category $category)
    {
        // Return view with category details
        return view('categories.show', compact('category'));
    }

    // Show the form for editing the specified resource.
    public function edit(Category $category)
    {
        // Return view to edit the category
        return view('categories.edit', compact('category'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Category $category)
    {
        // Delete the category
        $category->delete();

        // Redirect to Categories index with success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }





}
