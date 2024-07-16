<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-scroll">

            @include('layouts.header')

            @if(\Session::has('success'))
            <div class="bg-green-500 py-2 px-4 rounded-md text-white text-center fixed bottom-4 right-4 flex gap-4">
                <p>{!! \Session::get('success') !!}</p>
                <span class="cursor-pointer font-bold" onclick="return this.parentNode.remove()"><sup>X</sup></span>
            </div>
            @endif


            @if(\Session::has('error'))
            <div id="errorNotification" class="bg-red-500 py-2 px-4 rounded-md text-white text-center fixed bottom-4 right-4 flex gap-4">
                <p>Error! {!! \Session::get('error') !!}</p>
                <span class="cursor-pointer font-bold" onclick="return this.parentNode.remove()"><sup>X</sup></span>
            </div>
            @endif

            @if ($errors->any())
            <div id="errorNotification" class="bg-red-500 py-2 px-4 rounded-md text-white text-center fixed bottom-4 right-4 flex gap-4">
                <p> @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </p>
                <span class="cursor-pointer font-bold" onclick="return this.parentNode.remove()"><sup>X</sup></span>
            </div>
            @endif

            {{ $slot }}

        </div>
    </div>
</body>

</html>