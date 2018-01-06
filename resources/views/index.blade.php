<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <div id="app">
            <composer></composer>
            <ul>
                <div>
                    <thread v-for="thread in threads" :title="thread.title"></thread>
                </div>
                @foreach ($threads as $thread)
                    <li>
                        {{ $thread->title }}
                    </li>
                @endforeach
            </ul>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
