<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\View\View;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use App\Repositories\TaskRepositoryInterface;
use App\Http\Requests\Comment\StoreRequest as CommentStoreRequest;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = $this->taskRepository->index();
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
        $this->taskRepository->store($request);
        return to_route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = $this->taskRepository->find($id);
        return view('tasks.show')->with(compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $task = $this->taskRepository->find($id);
        return view('tasks.edit')->with(compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateRequest $request): RedirectResponse
    {
        $this->taskRepository->update($id, $request);
        return to_route('tasks.index');
    }

    public function complete(int $id): RedirectResponse{
        $this->taskRepository->markAsCompleted($id);
        return to_route('tasks.index');
    }

    public function yetComplete(int $id): RedirectResponse{
        $this->taskRepository->markAsInComplete($id);
        return to_route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->taskRepository->delete($id);
        return to_route('tasks.index');
    }

    public function storeComment(int $id, CommentStoreRequest $request): RedirectResponse
    {
        $this->taskRepository->addComment($id, $request);
        $task = $this->taskRepository->find($id);
        return to_route('tasks.show', $id)->with(compact('task'));
    }

    public function createComment(int $id): View
    {
        $task = $this->taskRepository->find($id);
        return view('tasks.createComment')->with(compact('task'));
    }

    public function editComment(int $commentId): View
    {
        $comment = Comment::find($commentId);
        return view('tasks.editComment')->with(compact('comment'));
    }

    public function updateComment(int $comment_id, CommentStoreRequest $request): RedirectResponse
    {
        $this->taskRepository->editComment($comment_id, $request);
        $task = Comment::find($comment_id)->task;
        return to_route('tasks.show', $task->id)->with(compact('task'));
    }

    // public function deleteComment(Task $task, int $comment_id): RedirectResponse{
    //     $this->taskRepository->deleteComment($comment_id);
    //     $task->refresh();
    //     $tasks = Task::all();
    //     return to_route('tasks.index')->with(compact('tasks'));
    // }

}
