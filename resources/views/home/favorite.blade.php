<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
</head>

<body class="bg-custom-darkblue">
    {{-- !modal add library! --}}
    <section class="w-screen h-screen fixed z-10 justify-center items-center hidden" id="library-modal">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-4/12">
            <div class="flex justify-between items-center">
                <p class="text-2xl">Create Your Library :</p>
                <button onclick="closeModal()" class="bg-red-400 border-[1px] px-2 rounded-[4px]">X</button>
            </div>
            <form action="/home/library" method="post" class="mt-4">
                @csrf
                <div class="flex items-center mb-4">
                    <p class="">URL Platform :</p>
                    <select class="ml-2" name="platform" class="">
                        <option value="YouTube" class="bg-custom-pink">YouTube</option>
                        <option value="Spotify" class="bg-custom-pink">Spotify</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <p class="mr-2 text-nowrap">Library's Name :</p>
                    <input type="text" name="title" class="p-2 w-full border-[1px] rounded-[8px]" required>
                </div>
                <div class="flex mt-4 items-center">
                    <p class="mr-2 text-nowrap">Description :</p>
                    <input type="text" name="description" class="border-[1px] w-full p-2 rounded-[8px]">
                </div>
                <button type="submit" onclick="submitModal()" class="bg-custom-pink p-2 w-full mt-4 rounded-[10px]">Add
                    Library</button>
            </form>
        </div>
    </section>
    {{-- !modal update library! --}}
    <section class="w-screen h-screen fixed z-11 justify-center items-center hidden" id="library-edit-modal">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-4/12">
            <div class="flex justify-between items-center">
                <p class="text-2xl">Edit Your Library :</p>
                <button onclick="closeModal()" class="bg-red-400 border-[1px] px-2 rounded-[4px]">X</button>
            </div>
            <form class="mt-4" id="form-update-library">
                @csrf
                <input type="hidden" name="libraries_id">
                <div class="flex items-center">
                    <p class="mr-2 text-nowrap">Library's Name :</p>
                    <input type="text" name="title" class="p-2 w-full border-[1px] rounded-[8px]" required
                        value="">
                </div>
                <div class="flex mt-4 items-center">
                    <p class="mr-2 text-nowrap">Description :</p>
                    <input type="text" name="description" class="border-[1px] w-full p-2 rounded-[8px]"
                        value="">
                </div>
                <button type="submit" onclick="submitModal()"
                    class="bg-custom-pink p-2 w-full mt-4 rounded-[10px]">Edit
                    Library</button>
            </form>
        </div>
    </section>
    {{-- !modal add playlist! --}}
    <section class="w-screen h-screen fixed z-12 justify-center items-center hidden" id="url-modal">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-4/12">
            <div class="flex justify-between items-center">
                <p class="text-2xl">Insert URL :</p>
                <button onclick="closeModal()" class="bg-red-400 border-[1px] px-2 rounded-[4px]">X</button>
            </div>
            <form class="mt-4" id="form-add-playlist">
                @csrf
                <input type="hidden" name="libraries_id" value="">
                <input name="songs" type="text" class="p-2 w-full border-[1px] rounded-[4px]"
                    placeholder="Title song">
                <input name="url_link" type="text" class="p-2 w-full border-[1px] rounded-[4px] mt-4"
                    placeholder="Your URL">
                <button type="submit" onclick="submitModal()"
                    class="bg-custom-pink p-2 w-full mt-4 rounded-[10px]">Enter</button>
            </form>
        </div>
    </section>
    {{-- modal update playlist --}}
    <section class="w-screen h-screen fixed z-13 justify-center items-center hidden" id="modal-url-update">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-4/12">
            <div class="flex justify-between items-center">
                <p class="text-2xl">Edit Playlist :</p>
                <button onclick="closeModal()" class="bg-red-400 border-[1px] px-2 rounded-[4px]">X</button>
            </div>
            <form class="mt-4" id="form-update-playlist">
                @csrf
                <input type="hidden" name="playlist_id" value="">
                <input name="songs" type="text" class="p-2 w-full border-[1px] rounded-[4px]"
                    placeholder="Title song">
                <input name="url_link" type="text" class="p-2 w-full border-[1px] rounded-[4px] mt-4"
                    placeholder="Your URL">
                <button type="submit" onclick="submitModal()"
                    class="bg-custom-pink p-2 w-full mt-4 rounded-[10px]">Enter</button>
            </form>
        </div>
    </section>
    {{-- modal delete library --}}
    <section class="w-screen h-screen fixed z-14 justify-center items-center hidden" id="library-del">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-2/12">
            <form action="/library/delete" method="post">
                @csrf
                <input type="hidden" name="libraries_id">
                <div class="text-2xl text-center cursor-pointer">Delete Library?</div>
                <div class="flex justify-between mt-2 px-8">
                    <button type="submit" class="text-xl px-4 py-2 cursor-pointer">Yes</button>
                    <p class="text-xl px-4 py-2 cursor-pointer" onclick="closeModal()">Cancel</p>
                </div>
            </form>
        </div>
    </section>
    {{-- modal playlist delete --}}
    <section class="w-screen h-screen fixed z-15 justify-center items-center hidden" id="playlist-del">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-2/12">
            <form id="form-delete-playlist">
                @csrf
                <div class="text-2xl text-center cursor-pointer">Delete Playlist?</div>
                <div class="flex justify-between mt-2 px-8">
                    <input type="hidden" name="playlist_id">
                    <button type="submit" class="text-xl px-4 py-2 cursor-pointer">Yes</button>
                    <p class="text-xl px-4 py-2 cursor-pointer" onclick="closeModal()">Cancel</p>
                </div>
            </form>
        </div>
    </section>

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
            <button class="bg-pink-900 mt-2 mb-2 p-2 w-full flex items-center cursor-pointer rounded-[4px] hover:border-[1px] hover:border-pink-600 hover:bg-pink-800"
                onclick="modalAddLibrary()">
                <img src="{{ asset('assets/img/icon_plus_only.svg') }}" class="mr-2">
                <p class="text-xl">New Library</p>
            </button>
            <p class="p-2 cursor-pointer hover:border-[1px] hover:border-pink-600 hover:text-gray-300 hover:bg-pink-800 rounded-[4px]"><a href="/home">All Libraries</a></p>
            <p class="p-2 cursor-pointer border-pink-600 border-b-[1px] hover:border-[1px] hover:border-pink-600 hover:text-gray-400 hover:bg-pink-800 rounded-[4px]"><a href="/home/favorite">Favorite</a></p>
            <p class="p-2 cursor-pointer hover:border-[1px] hover:border-pink-600 hover:text-gray-300 hover:bg-pink-800 rounded-[4px]"><a href="/home/recently">Recently Viewed</a></p>
            <p class="p-2 cursor-pointer hover:border-[1px] hover:border-pink-600 hover:text-gray-300 hover:bg-pink-800 rounded-[4px]"><a href="">About</a></p>
        </nav>
        {{-- main dashboard --}}
        <main id="main-dashboard" class="h-full flex-1 mt-4 ml-4 mr-4 overflow-hidden">
            <div class="flex justify-between">
                <h1 class="text-2xl">All Libraries</h1>
                <div class="">
                    @auth
                        <form action="{{ route('logout.btn') }}" method="post">
                            @csrf
                            <button type="submt"
                                class="p-2 px-6 border-white border-[1px] rounded-[4px]">Logout</button>
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
                @foreach ($favorite as $library)
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
                        <img src="{{ asset('assets/img/icon_edit.svg') }}" class="cursor-pointer"
                            onclick="editModal()">
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
