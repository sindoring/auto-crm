<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('js/landing.js') }}" defer></script>
        <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
        <title>CRM</title>
    </head>
    <body>
        <div id="landing">
            <landing-component></landing-component>
        </div>
    </body>
</html>
