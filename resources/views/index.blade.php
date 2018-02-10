<!DOCTYPE html>
<html>
    <head>
        <title>Message Board</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,400i" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/style.css" />
    </head>
    <body>
        <div id="app" class="wrapper">
            <thread-composer></thread-composer>
            <threads v-bind:data='{!! htmlspecialchars($threads, ENT_QUOTES) !!}'></threads>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
