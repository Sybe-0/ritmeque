<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
</head>

<body class="bg-custom-darkblue">
    <div class="flex h-screen w-screen text-xl ">
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
            <p class="p-2 cursor-pointer"><a href="/home">All Libraries</a></p>
            <p class="p-2 cursor-pointer"><a href="/home/favorite">Favorite</a></p>
            <p class="p-2 cursor-pointer border-pink-400 border-b-[1px]"><a href="/home/recently">Recently Viewed</a></p>
            <p class="p-2 cursor-pointer"><a href="">About</a></p>
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
                            <a href="{{ url('/signin') }}">Login</a>
                        </button>
                        <button class="p-2 px-6 border-white border-[1px] rounded-[4px]">
                            <a href="{{ url('/signup') }}">Register</a>
                        </button>
                    @endauth
                </div>
            </div>

            {{-- libraries area --}}
            <div class="flex mt-2">
                @foreach ($recently as $library)
                    <div class="bg-[#1e1e1e] mr-2 p-2 w-38 h-42 border-[1px] rounded-[8px]"
                        onclick="libraries({{ $library->id }})">
                        <div class="">{{ $library->title }}</div>
                        <div class="">URL: {{ $library->platform }}</div>
                    </div>
                @endforeach
            </div>
            {{--  --}}
            <div class="flex mt-4" id="playlist-area">
                {{-- playlist --}}
                <div class="basis-3/4 mr-4 h-full overflow-y-auto">
                    <ul id="playlist-table" class=""></ul>
                </div>
                {{-- desc library area --}}
                <div class="bg-[#1b1e33] p-2 flex-col flex-1 h-full border-[1px] rounded-[6px] hidden"
                    id="show-desc-area">
                    <div class="flex items-center justify-between">
                        <p class="">Play Libraries :</p>
                        <img src="{{ asset('assets/img/icon_play.svg') }}" class="cursor-pointer">
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <div class="flex">
                            <div id="library-platform"></div>
                            <p class="ml-2" id="library-platform"> Libraries :</p>
                        </div>
                        <img src="{{ asset('assets/img/icon_edit.svg') }}" class="cursor-pointer" onclick="editModal()">
                    </div>
                    <div class="m-2 ">
                        <div class="flex justify-between items-center">
                            <p>Name =</p>
                            <div id="library-title"></div>
                        </div>
                        <div class="mt-2 max-h-42">
                            <p>Desc =</p>
                            <div id="library-description"></div>
                        </div>
                        <div class="mt-2 flex justify-between items-center">
                            <p>Favorite =</p>
                            <input type="checkbox" name="is_favorite" class="input-fav">
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <p>Delete Libraries :</p>
                        <img src="{{ asset('assets/img/icon_trash.svg') }}" class="mt-2 cursor-pointer"
                            onclick="librariesDelete()">
                    </div>
                    <button
                        class="bg-custom-pink p-2 mt-4 w-full self-end flex items-center cursor-pointer rounded-[2px]"
                        onclick="urlInput()">
                        <img src="{{ asset('assets/img/icon_plus_only.svg') }}">
                        <p>Add PLaylist</p>
                    </button>
                </div>
            </div>

            <div id="result-library"></div>
        </main>
    </div>

    <script src="{{ asset('assets/js/lobby_btn.js') }}"></script>
    <script src="{{ asset('assets/js/lobby_fetch.js') }}"></script>
</body>

</html>
