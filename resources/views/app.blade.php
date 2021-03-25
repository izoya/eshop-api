<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') . '?t=' . microtime(true) }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>@section('title'){{ config('app.name', 'Laravel') }}@show</title>
</head>
<body>
<div id="app">
    <app-container></app-container>
</div>

<script >
</script>
</body>
</html>
