<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest; // Import the UpdateRequest class
use Illuminate\Support\Facades\DB;
use App\Models\Task; // Import the Task model class
use Illuminate\Http\RedirectResponse; // Import the RedirectResponse class

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Task::orderBy('is_completed')
            ->orderBy('id')
            ->get();

        return view('tasks.index')->with(compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $task = DB::transaction(fn() => Task::create($request->validated()));
        return to_route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show')->with(compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit')->with(compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Task $task): RedirectResponse
    {
        DB::transaction(fn() => $task->update($request->validated()));

        return to_route('tasks.index');
    }

    public function complete(Task $task): RedirectResponse
    {
        DB::transaction(fn() => $task->update(['is_completed' => true]));

        return to_route('tasks.index');
    }

    public function yetComplete(Task $task): RedirectResponse
        {
            DB::transaction(fn() => $task->update(['is_completed' => false]));

            return to_route('tasks.index');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        DB::transaction(fn() => $task->delete());

        return to_route('tasks.index');
    }
}
