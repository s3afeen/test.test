<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        $productsCount = Product::count();

        return view('userSide.contact' , ['contacts'=> $contacts ,'productsCount'=>$productsCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Contact::create([
            'name'=>$request->input('name'),
            'message'=>$request->input('message'),
            'email'=>$request->input('email'),

        ]);
        return redirect()->back()->with('success', 'Thanks for contact us');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $contacts = Contact::all();
        // return view('contacts.show' , ['contacts'=> $contacts]);
    }
    public function showAll()
    {
        // جلب جميع البيانات من جدول الاتصال
        $contacts = Contact::all();

        // إرجاع العرض مع البيانات
        return view('contact.index', compact('contacts'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // $contact->delete();

        // return to_route('contacts.index')->with('success', 'Message deleted');
    }
}
