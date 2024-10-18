<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $searchInput = $request->input('search');
        $tasksData = Task::all();
        $randomNotCompletedTasks = Task::select('id', 'title')
            ->where('completed', false)
            ->inRandomOrder()
            ->take(6)
            ->get();
            
        return Inertia::render('Tasks/TaskList', compact('searchInput', 'tasksData', 'randomNotCompletedTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required | max:255',
            'description' => 'required',
            'long_description' => 'required',
        ]);
    
        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->long_description = $data['long_description'];
        $task->save();
    
        return redirect()->route('tasks.index', ['task' => $task]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task = Task::findorfail($task->id);
      
        return Inertia::render('Tasks/TaskShow', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        
        return Inertia::render('Tasks/TaskEdit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate incoming request data
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    // Update the task
    $task->update($data);

    // Redirect back to the task's show page or the tasks list
    return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
