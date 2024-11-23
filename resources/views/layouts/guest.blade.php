<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tes-top - Sistema de gestão de stock</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div  class="font-sans text-gray-900 antialiased" style="background: rgb(199,146,30);
        background: linear-gradient(326deg, rgba(199,146,30,1) 0%, rgba(9,42,36,0.6194852941176471) 35%, rgb(0 255 51 / 34%) 100%);">
            {{ $slot }}
        </div>
    </body>
</html>
