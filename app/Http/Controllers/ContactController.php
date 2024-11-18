<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        return view('userSide.contact', compact('productsCount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Thank you for your message. We will contact you soon!');
    }

    public function showAll()
    {
        $contacts = Contact::latest()->get();
        return view('contact.index', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.showAll')->with('success', 'Message deleted successfully');
    }
}
