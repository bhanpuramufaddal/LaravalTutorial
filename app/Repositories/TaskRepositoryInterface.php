<?php
namespace App\Repositories;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest; 
use App\Models\Task;
use Illuminate\Support\Collection;
use App\Http\Requests\Comment\StoreRequest as CommentStoreRequest;

/**
 * Interface TaskRepositoryInterface
 * @package App\Repositories\KeikoGpt
 */
interface TaskRepositoryInterface {
    /**
     * 全てのタスクを取得します。
     *
     * @return Collection
     */
    public function index(): Collection;

    /**
     * IDでタスクを検索します。
     *
     * @param int $id
     * @return Task|null
     */
    public function find(int $id): ?Task;

    /**
     * 新しいタスクを保存します。
     *
     * @param StoreRequest $request
     * @return Task
     */
    public function store(StoreRequest $request): Task;

    /**
     * タスクを更新します。
     *
     * @param int $id
     * @return bool
     */
    public function update(int $id, UpdateRequest $request): bool;

    /**
     * タスクを削除します。
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * タスクを完了済みにします。
     *
     * @param int $id
     * @return bool
     */
    public function markAsCompleted(int $id): bool;

    /**
     * タスクを未完了にします。
     *
     * @param int $id
     * @return bool
     */
    public function markAsInComplete(int $id): bool;

    /**
     * タスクにコメントを追加します。
     *
     * @param int $id
     * @param CommentStoreRequest $request
     * @return bool
    
     */
    public function addComment(int $id, CommentStoreRequest $request): bool;

    /**
     * タスクのコメントを取得します。
     *
     * @param int $id
     * @return Collection
     */
    public function getComments(int $id): Collection;

    /**
     * タスクのコメントを削除します。
     *
     * @param int $id
     * @param int $comment
     * @param CommentStoreRequest $request
     * @return bool
     */
    public function editComment(int $comment_id, CommentStoreRequest $request): bool;

    /**
     * タスクのコメントを削除します。
     *
     * @param int $id
     * @param int $comment_id
     * @return bool
     */
    public function deleteComment(int $comment_id): bool;
}
