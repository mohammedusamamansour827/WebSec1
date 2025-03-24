<?php

namespace App\Http\Controllers;
/** @var \App\Models\User $user */


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Make sure user is authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all tasks for the logged-in user
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get(); // this overrides the first line

        return view('tasks.index', compact('tasks')); // pass to view
    }



    // Show the form to create a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store the new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();
        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);


        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show a single task
    public function show(Task $task)
    {
        $this->authorize('view', $task); // optional authorization
        return view('tasks.show', compact('task'));
    }

    // Show form to edit a task
    public function edit(Task $task)
    {
        $this->authorize('update', $task); // optional authorization
        return view('tasks.edit', compact('task'));
    }

    // Update the task
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task); // optional authorization

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete the task
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task); // optional authorization
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

}
