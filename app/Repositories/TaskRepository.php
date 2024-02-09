<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Collection;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Repositories\TaskRepositoryInterface;
use App\Http\Requests\Comment\StoreRequest as CommentStoreRequest;
use App\Models\Comment;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Get all tasks.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        $tasks = Task::orderBy('is_completed')
            ->orderBy('id')
            ->get();

        return $tasks;
    }

    /**
     * Find a task by ID.
     *
     * @param int $id
     * @return Task|null
     */
    public function find(int $id): ?Task
    {
        return Task::find($id);
    }

    /**
     * Store a new task.
     *
     * @param StoreRequest $request
     * @return Task
     */
    public function store(StoreRequest $request): Task
    {
        return Task::create($request->validated());
    }

    /**
     * Update a task.
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return bool
     */
    public function update(int $id, UpdateRequest $request): bool
    {
        $task = Task::find($id);

        return $task->update($request->validated());
    }

    /**
     * Delete a task.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Task::destroy($id);
    }

    /**
     * Mark a task as completed.
     *
     * @param int $id
     * @return bool
     */
    public function markAsCompleted(int $id): bool
    {
        $task = Task::find($id);

        return $task->update(['is_completed' => true]);
    }

    /**
     * Mark a task as incomplete.
     *
     * @param int $id
     * @return bool
     */
    public function markAsIncomplete(int $id): bool
    {
        $task = Task::find($id);

        return $task->update(['is_completed' => false]);
    }

    /**
     * Add a comment to a task.
     *
     * @param int $id
     * @param CommentStoreRequest $request
     * @return bool
     */
    public function addComment(int $id, CommentStoreRequest $request): bool
    {
        $task = Task::find($id);
        $comment = $task->comments()->create($request->validated());

        return $comment !== null;
    }

    /**
     * Get comments of a task.
     *
     * @param int $id
     * @return Collection
     */
    public function getComments(int $id): Collection
    {
        $task = Task::find($id);

        return $task->comments;
    }

    /**
     * Edit a comment of a task.
     *
     * @param int $comment_id
     * @param CommentStoreRequest $request
     * @return bool
     */
    public function editComment(int $comment_id, CommentStoreRequest $request): bool
    {
        $comment = Comment::find($comment_id);

        return $comment->update($request->validated());
    }

    /**
     * Delete a comment of a task.
     *
     * @param int $comment_id
     * @return bool
     */
    public function deleteComment(int $comment_id): bool
    {
        return Comment::destroy($comment_id);
    }
}

