<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
<section class="hero is-black">
    <div class="hero-body">
        <p class="title">
            Task Managements
        </p>
    </div>
</section>
@if($errors->any())
    <div class="notification is-danger">
        <button class="delete"></button>
        <ul>
            @foreach(\Illuminate\Support\Arr::flatten($errors->get('*')) as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="section">
    <h1 class="title">Tasks | Show: {{ $task->id }}</h1>
    <div class="card">
        <div class="card-content">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">ID</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" value="{{ $task->id }}" disabled>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Title</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" value="{{ $task->title }}" disabled>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Description</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea" disabled>{{ $task->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">is_completed</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" value="{{ $task->is_completed ? 'Done' : 'Yet' }}" disabled>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">created_at</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" value="{{ $task->created_at }}" disabled>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">updated_at</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" value="{{ $task->updated_at }}" disabled>
                        </p>
                    </div>
                </div>
            </div>

            <section class="section">
                <h2 class="title is-4">Comments</h2>
                <div class="container">
                    @forelse ($task->comments as $comment)
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            </div>

                            <nav class="level is-mobile">
                                <div class="level-left">
                                    <a class="level-item" aria-label="edit" href="{{ route('tasks.comment.edit', $comment) }}">
                                        <span class="icon is-small has-text-black">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <a class="level-item" aria-label="delete" href="">
                                        <span class="icon is-small has-text-black">
                                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                            </nav>

                        </article>
                    @empty
                        <p>No comments yet.</p>
                    @endforelse
                </div>
            </section>


            <footer class="card-footer">
                <a class="card-footer-item button is-black" href="{{ route('tasks.edit', $task) }}">
                    Edit Task
                </a>

                <a class="card-footer-item button has-background-grey-light" href="{{ route('tasks.comment.create', $task) }}">
                    Add Comment
                </a>
            </footer>
        </div>
    </div>
</section>
</body>
</html>