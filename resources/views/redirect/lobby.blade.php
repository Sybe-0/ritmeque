<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RitmeQue Home</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-custom-darkblue flex">
    <section class="bg-custom-pink basis-1/4 h-screen">
        <div class="flex items-center p-2 mt-1.5">
            <img src="{{ asset('assets/img/icon_not.svg') }}" class="mr-2">
            <h1 class="font-semibold text-2xl">Your Library</h1>
        </div>
        <div class="bg-white w-full h-0.5 mb-1"></div>
        <div class="p-2">
            <div class="flex items-center p-2 bg-pink-900">
            <img src="{{ asset('assets/img/icon_register.svg') }}" class="mr-2">
            <h3 class="text-xl">Register</h3>
        </div>
        <div class="flex items-center p-2">
            <img src="{{ asset('assets/img/icon_plus_only.svg') }}" class="mr-2">
            <p class="text-xl">New Library</p>
        </div>
        </div>
        <div class="flex items-center p-2">
            <img src="{{ asset('assets/img/icon_love.svg') }}" class="mr-2">
            <p class="text-xl">Favorit</p>
        </div>
        <div class="flex items-center p-2">
            <img src="{{ asset('assets/img/icon_recently.svg') }}" class="mr-2">
            <p class="text-xl">Recently View</p>
        </div>
        <div class="flex items-center p-2">
            <img src="{{ asset('assets/img/icon_setting.svg') }}" class="mr-2">
            <p class="text-xl">Setting</p>
        </div>
        <div class="flex items-center p-2">
            <img src="{{ asset('assets/img/icon_info.svg') }}" class="mr-2">
            <p class="text-xl">About</p>
        </div>
    </section>
    <section class="basis-3/4">
        <h1 class="text-2xl font-bold p-2 mt-1 ml-1">All Libraries</h1>
        <div class="flex "></div>
    </section>
</body>
</html>