<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('feedbacks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required',
        ]);

        Feedback::create($validatedData);
        return redirect()->route('feedbacks.index')->with('success', 'Feedback created successfully.');
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('feedbacks.show', compact('feedback'));
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('feedbacks.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'message' => 'required',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update($validatedData);
        return redirect()->route('feedbacks.index')->with('success', 'Feedback updated successfully.');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
    }
}
