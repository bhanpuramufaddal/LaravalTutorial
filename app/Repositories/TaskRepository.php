<?php
// Create the task repository class 
// Path: app/Repositories/TaskRepository.php
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
     * 全てのタスクを取得します。
     *
     * @return Collection
     */
    public function index(): Collection {
        $tasks = Task::orderBy('is_completed')
            ->orderBy('id')
            ->get();
        return $tasks;
    }

    /**
     * IDでタスクを検索します。
     *
     * @param int $id
     * @return Task|null
     */
    public function find(int $id): ?Task{
        return Task::find($id);
    }

    /**
     * タスクを更新します。
     *
     * @param Task $task
     * @return Task $task
     */
    public function store(StoreRequest $request): Task{
        return Task::create($request->validated());
    }

    /**
     * 新しいタスクを保存します。
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return bool
     */
    public function update(int $id, UpdateRequest $request): bool{
        $task = Task::find($id);
        return $task->update($request->validated());
    }

    /**
     * タスクを削除します。
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool{
        return Task::destroy($id);
    }

    /**
     * タスクを完了します。
     *
     * @param int $id
     * @return bool
     */
    public function markAsCompleted(int $id): bool{
        $task = Task::find($id);
        return $task->update(['is_completed' => true]);
    }

    /**
     * タスクを未完了にします。
     *
     * @param int $id
     * @return bool
     */
    public function markAsInComplete(int $id): bool{
        $task = Task::find($id);
        return $task->update(['is_completed' => false]);
    }

    /**
     * タスクにコメントを追加します。
     *
     * @param int $id
     * @param string $comment
     * @return bool
     */
    public function addComment(int $id, CommentStoreRequest $request): bool{
        $task = Task::find($id);
        $comment = $task->comments()->create($request->validated());
        return $comment !== null;
    }

    /**
     * タスクのコメントを取得します。
     *
     * @param int $id
     * @return Collection
     */
    public function getComments(int $id): Collection{
        $task = Task::find($id);
        return $task->comments;
    }

    /**
     * タスクのコメントを削除します。
     *
     * @param int $id
     * @return bool
     */
    public function editComment(int $comment_id, CommentStoreRequest $request): bool{
        $comment = Comment::find($comment_id);
        return $comment->update($request->validated());
    }

    /**
     * タスクのコメントを削除します。
     *
     * @param int $comment_id
     * @return bool
     */
        
    public function deleteComment(int $comment_id): bool{
        return Comment::destroy($comment_id);;
    }
}

