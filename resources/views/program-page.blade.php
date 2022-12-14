<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="/css/app.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>
<div id="app">
    <program-page :program-data="{{$program}}" :trainer-data="{{$program->treneriai}}" :review-data="{{$program->atsiliepimai}}"></program-page>

</div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
