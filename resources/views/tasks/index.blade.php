<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .icon-button {
            font-size: 1.5em; /* Increase icon size */
            margin-left: 0.5em; /* Add space between buttons */
            cursor: pointer; /* Change cursor to pointer on hover */
        }
        .box {
            position: relative; /* Set relative positioning for the parent */
            padding-right: 140px; /* Add padding to prevent text from overlapping buttons */
        }
        .buttons-container {
            position: absolute; /* Absolute positioning for the buttons */
            right: 10px; /* Place the buttons 10px from the right edge */
            top: 50%; /* Align buttons vertically */
            transform: translateY(-50%); /* Center buttons vertically */
            display: flex;
            flex-direction: row; /* Align buttons horizontally */
            align-items: center; /* Center buttons vertically */
        }
        .buttons-container > form,
        .buttons-container > a {
            margin-left: 0.5em; /* Add space between buttons */
        }
        .buttons-container > form button,
        .buttons-container > a {
            border: none; /* Remove button border */
            background: none; /* Remove button background */
            padding: 0; /* Remove button padding */
        }
        .create-task-button {
            display: block; /* Make the button a block element */
            background-color: black; /* Set the button background color to black */
            color: white; /* Set the button text color to white */
            padding: 0.5em 1em; /* Add horizontal padding to the button */
            margin-bottom: 1em; /* Add margin bottom to prevent bumping into task panel */
            text-decoration: none; /* Remove text decoration */
        }

        .create-task-button:hover {
            color: white; /* Set the button text color to white on hover */
        }
    </style>
</head>
<body>
<section class="hero is-black">
    <div class="hero-body">
        <p class="title">
            Task Management
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
    <h1 class="title">Tasks | Index</h1>
    <h2 class="subtitle">
        <a href="{{ route('tasks.create') }}" class="create-task-button">Create Task</a>
    </h2>
    <div class="tile is-ancestor">
        <div class="tile is-vertical">
            @foreach($tasks as $task)
                <div class="tile is-parent">
                    <div class="tile is-child box @if($task->is_completed) has-background-grey-lighter @endif">
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{{ $task->title }}</strong>
                                        <br>
                                        {{ $task->description }}
                                    </p>
                                </div>
                            </div>
                        </article>
                        <div class="buttons-container">
                            <!-- Show button -->
                            <a href="{{ route('tasks.show', $task) }}" class="icon-button has-text-black">
                                <span class="icon">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </span>
                            </a>
                            <!-- Complete/Incomplete toggle button -->
                            <form method="post" action="{{ $task->is_completed ? route('tasks.yet_complete', $task) : route('tasks.complete', $task) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="icon-button">
                                    <span class="icon">
                                        <i class="fa-solid {{ $task->is_completed ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                                    </span>
                                </button>
                            </form>
                            <!-- Delete button -->
                            <form method="post" action="{{ route('tasks.destroy', $task) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-button">
                                    <span class="icon">
                                        <i class="fa-solid fa-trash"></i>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="button is-fullwidth is-black">Logout</button>
    </form>
</section>
</body>
</html>