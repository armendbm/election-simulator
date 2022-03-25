<!doctype html>
<html lang="en" class="h-100">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Stylesheets -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

        
        {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}

        <title>{{ config('app.name', 'Elections To Go') }}</title>
    </head>
    <body class="d-flex flex-column h-100">
        <header class="site-header sticky-top">
            @include('layouts.navigation')
        </header>
        <main>
            <div class="container">
                {{ $slot }}
            </div>
        </main>
        <footer class="mt-auto py-3 bg-light">
            <div class="container text-center">
                <span class="text-muted">Copyright &copy; 2022 Albert Dong, Po Jui Juan, Parker McCormick, Armend Murtishi, and Noah Pedroso. All rights reserved.</span>
            </div>
        </footer>
        @include('sweetalert::alert')
    </body>
</html>
