<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
<section class="hero is-black">
    <div class="hero-body">
        <p class="title">
            Write a Comment
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
    <form method="post" action="{{ route('tasks.comment.store', $task) }}">
        @csrf
        <div class="card">
            <div class="card-content">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="description">Comment</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea id="comment" name="comment" class="textarea"
                                          placeholder="Write Your Comment Here"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="card-footer">
                    <button type="submit" class="card-footer-item button is-black">Add Coment</button>
                </footer>
            </div>
        </div>
    </form>
</section>
</body>
</html>