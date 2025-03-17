<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question; // ✅ Import the Question model

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::all();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create'); // ✅ Return a view for creating questions
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate the request
        $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|string',
        ]);

        // ✅ Create a new question
        Question::create($request->all());

        return redirect()->route('questions.index')->with('success', 'Question added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::findOrFail($id);
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ✅ Validate the request
        $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|string',
        ]);

        // ✅ Update the question
        $question = Question::findOrFail($id);
        $question->update($request->all());

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
    }
}
