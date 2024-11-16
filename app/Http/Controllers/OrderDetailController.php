<?php
namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return view('orderDetails.index', compact('orderDetails'));
    }

    public function create()
    {
        return view('orderDetails.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        OrderDetail::create($validatedData);
        return redirect()->route('orderDetails.index')->with('success', 'Order detail created successfully.');
    }

    public function show($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return view('orderDetails.show', compact('orderDetail'));
    }

    public function edit($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return view('orderDetails.edit', compact('orderDetail'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->update($validatedData);
        return redirect()->route('orderDetails.index')->with('success', 'Order detail updated successfully.');
    }

    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();
        return redirect()->route('orderDetails.index')->with('success', 'Order detail deleted successfully.');
    }
}
