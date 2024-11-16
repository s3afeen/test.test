<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class ReportController extends Controller
{
    public function index()
    {
        $totalSales = Order::sum('total');
        $orderCount = Order::count();
        $userCount = User::count();
        $topProducts = Product::orderBy('quantity_sold', 'desc')->take(5)->get();

        return view('reports.index', compact('totalSales', 'orderCount', 'userCount', 'topProducts'));
    }
}
