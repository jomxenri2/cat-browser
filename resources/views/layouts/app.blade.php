<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cat Browser</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://grumpy.iona.dev/static/css/main.49481be8.chunk.css">
    
</head>
<body>

    <div id="app"></div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
