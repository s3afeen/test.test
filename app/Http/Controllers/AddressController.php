<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'address_line' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);

        Address::create($validatedData);
        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
    }

    public function show($id)
    {
        $address = Address::findOrFail($id);
        return view('addresses.show', compact('address'));
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'address_line' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);

        $address = Address::findOrFail($id);
        $address->update($validatedData);
        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
    }
}
