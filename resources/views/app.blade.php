<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
        {{-- <script src="{{ asset('DataTables/datatables.min.js') }}"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
        <!--  Vuelidate -->
        <script src="https://cdn.jsdelivr.net/npm/vue-demi"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vuelidate/core"></script>
        <script src="https://cdn.jsdelivr.net/npm/@vuelidate/validators"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div id="app">

            @inertia
        </div>
        @vite('resources/js/app.js')

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </body>
</html>
