<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    {{-- navbar --}}
    <nav class="bg-custom-pink px-2 h-full max-w2/5 basis-1/5">
        <div class="flex items-center p-2 mt-1.5">
            <img src="{{ asset('assets/img/icon_not.svg') }}" class="mr-2">
            <h1 class="font-semibold text-2xl">Your Library</h1>
        </div>
        <div class="bg-white w-full h-0.5 mb-1"></div>
        <input type="search" name="query" id="search-library"
            class="bg-pink-700 w-full mt-4 p-2 rounded-[4px] focus:outline-none" placeholder="Search library">
        <button class="bg-pink-900 mt-2 mb-2 p-2 w-full flex items-center cursor-pointer rounded-[4px]"
            onclick="modalAddLibrary()">
            <img src="{{ asset('assets/img/icon_plus_only.svg') }}" class="mr-2">
            <p class="text-xl">New Library</p>
        </button>
        <p class="p-2 cursor-pointer border-pink-400 border-b-[1px]">All Libraries</p>
        <p class="p-2 cursor-pointer">Favorite</p>
        <p class="p-2 cursor-pointer">Recently Viewed</p>
        <p class="p-2 cursor-pointer">About</p>
    </nav>
    {{-- main dashboard --}}
    <main id="main-dashboard" class="h-full flex-1 mt-4 ml-4 mr-4 overflow-hidden">
        <div class="flex justify-between">
            <h1 class="text-2xl">All Libraries</h1>
            <div class="">
                @auth
                    <form action="{{ route('logout.btn') }}" method="post">
                        @csrf
                        <button type="submt" class="p-2 px-6 border-white border-[1px] rounded-[4px]">Logout</button>
                    </form>
                @else
                    <button class="bg-custom-pink mr-4 p-2 px-6 rounded-[4px]">
                        <a href="{{ url('/signup') }}">Login</a>
                    </button>
                    <button class="p-2 px-6 border-white border-[1px] rounded-[4px]">
                        <a href="{{ url('/signin') }}">Register</a>
                    </button>
                @endauth
            </div>
        </div>
    </main>
</body>

</html>
