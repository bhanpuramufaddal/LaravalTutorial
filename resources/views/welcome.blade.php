<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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

    <footer class="card-footer">
        <a class="card-footer-item button is-black" href="{{ route('register') }}">
            Register
        </a>
        <a class="card-footer-item button has-background-grey-light" href="{{ route('login') }}">
            Login
        </a>
    </footer>
    <div class="box">
        <div class="content">
        Welcome to our intuitive todo app, designed to simplify your task management and boost your productivity. 
        With our user-friendly interface, organizing your day has never been easier. 
        Whether you're tackling a mountain of work or planning your next big project, our app provides the tools you need to stay focused and on track. 
        From creating and prioritizing tasks to setting deadlines and receiving reminders, we've got you covered every step of the way. 
        Say goodbye to scattered to-do lists and hello to streamlined efficiency. Try our todo app today and take control of your schedule with ease.
        </div>
    </div>
</section>
</body>
</html>