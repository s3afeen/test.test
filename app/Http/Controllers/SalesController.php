<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function store(Request $request)
    {


        return redirect()->back()->with('success', 'Sales data saved successfully.');
    }
}
