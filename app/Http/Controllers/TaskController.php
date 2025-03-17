<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create'); // Ensure you have a 'tasks/create.blade.php' view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pending,completed',
        ]);

        Task::create([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
