<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @production
            @include('google')
        @endproduction
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="light dark">

        <title>{{ config('app.name', 'Baaltor') }}</title>

        @vite([
        'resources/css/bootstrap.css',
        'resources/css/bootstrap-nightfall.css',
        'resources/js/jquery-3.6.2.min.js',
        'resources/js/bootstrap.min.js'
        ])
    </head>
    <body class="baaltor">
        @include('default.header')
        <div class="container">
            {{ $slot }}
        </div>
    </body>
</html>
