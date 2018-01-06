<div id="app">
    <ul>
        <thread title="Foo"></thread>
        <Thread title="Bar"></Thread>
        @foreach ($threads as $thread)
            <li>
                {{ $thread->title }}
            </li>
        @endforeach
    </ul>
</div>
<script src="/js/app.js"></script>
