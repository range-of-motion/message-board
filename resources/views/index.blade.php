<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,400i" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/style.css" />
    </head>
    <body>
        <div id="app" class="wrapper">
            <composer></composer>
            <ul class="threads">
                <thread v-for="thread in threads" :created_at="thread.created_at" :title="thread.title"></thread>
                @foreach ($threads as $thread)
                    <li>
                        {{ $thread->created_at }} &middot; {{ $thread->title }}
                    </li>
                @endforeach
            </ul>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
