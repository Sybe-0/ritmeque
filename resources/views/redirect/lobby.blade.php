<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RitmeQue Home</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-custom-darkblue flex box-border h-screen max-h-screen">
    <section class="bg-custom-pink basis-1/4 min-w-3/12 h-screen fixed top-0 left-0">
        <div class="flex items-center p-2 mt-1.5">
            <img src="{{ asset('assets/img/icon_not.svg') }}" class="mr-2">
            <h1 class="font-semibold text-2xl">Your Library</h1>
        </div>
        <div class="bg-white w-full h-0.5 mb-1"></div>
        <div class="flex items-center p-2">
            <input class="flex items-center p-2 rounded-[8px] text-xl w-full bg-pink-700" name="query"
                placeholder="Search Library" id="search-library"></input>
        </div>
        <div class="flex items-center p-2">
            <button onclick="popModal()" class="flex items-center p-2 rounded-[8px] text-xl w-full bg-pink-900">
                <img src="{{ asset('assets/img/icon_plus_only.svg') }}" class="mr-2">New Library
            </button>
        </div>
        </div>
        <div class="flex items-center p-2">
            <p class="text-xl ml-2" onclick="libraryList()">All Libraries</p>
        </div>
        <div class="flex items-center p-2">
            <p class="text-xl ml-2">Favorit</p>
        </div>
        <div class="flex items-center p-2">
            <p class="text-xl ml-2">Recently View</p>
        </div>
        <div class="flex items-center p-2">
            <p class="text-xl ml-2">About</p>
        </div>
    </section>

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
                    <p class="">URL Platform</p>
                    <p class="ml-2">:</p>
                    <select class="ml-2" name="platform">
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
    {{-- main playlist --}}
    <section class="basis-3/4 min-w-9/12 fixed top-0 right-0 overflow-y-hidden">
        <div class="flex justify-between items-center mt-4 mx-2">
            <h1 class="text-2xl font-bold p-2" onclick="libraryList()">All Libraries</h1>
            @auth
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="p-2 px-6 border-[1px] border-white rounded-[4px]">Logout</button>
                </form>
            @else
                <div class="flex items-center">
                    <a href="{{ url('/signup') }}" class="mr-6">
                        <div class="p-2 px-6 bg-custom-pink rounded-[4px]">
                            <h3 class="text-xl">Register</h3>
                        </div>
                    </a>
                    <a href="{{ url('/signin') }}" class="mr-2">
                        <div class="p-2 px-6 border-[1px] border-white rounded-[4px]">
                            <h3 class="text-xl">Login</h3>
                        </div>
                    </a>
                </div>
            @endauth
        </div>
        {{-- libraries --}}
        <div id="default-libraries" class="flex overflow-x-hidden mt-4 max-w-[90rem]">
            @foreach ($datalibrary as $library)
                <div class="p-2 ml-4 bg-[#1e1e1e] w-36 h-42 flex flex-col border-[1px] rounded-[8px]"
                    onclick="libraries({{ $library->id }})">
                    <div class="w-30 h-20 bg-white m-auto rounded-[4px]"></div>
                    <div class="">{{ $library->platform }}</div>
                    <div class="">{{ $library->title }}</div>
                </div>
            @endforeach
        </div>
        <div class="flex m-2 text-2xl" id="result-library"></div>
        {{-- all libraries --}}
        <div id="all-libraries" class="hidden flex-wrap mt-4 max-w-[80rem]">
            @foreach ($datalibrary as $library)
                <form id="form-library-recently" class="p-2 ml-4 mt-4 bg-[#1e1e1e] w-36 h-42 flex flex-col border-[1px] rounded-[8px]"
                    onclick="libraries({{ $library->id }})">
                    @csrf
                    <div class="w-30 h-20 bg-white m-auto rounded-[4px]"></div>
                    <div class="">{{ $library->platform }}</div>
                    <div class="">{{ $library->title }}</div>
                </form>
            @endforeach
        </div>
        {{-- recently view --}}
        {{-- playlist --}}
        <div class="mt-4 flex" id="playlist-area">
            <div class="basis-3/4 px-4">
                <h2 class="text-2xl">Playlist</h2>
                {{--  --}}
                <ul class="" id="playlist-table"></ul>
            </div>
            <div class="basis-1/4 min-h-80 h-full border-[1px] px-6" id="show-border">
                <div class="text-2xl" id="library-title"></div>
                <div class="" id="library-description"></div>
                <div class="hidden items-center" id="url-btn">
                    <img src="{{ asset('assets/img/icon_plus_add.svg') }}" class="w-12" onclick="urlInput()">
                    <form id="form-fav-btn">
                        @csrf
                        <input type="hidden" name="libraries_id">
                        <img src="{{ asset('assets/img/icon_love.svg') }}" class="w-12" id="fav-btn">
                    </form>
                    <img src="{{ asset('assets/img/icon_trash.svg') }}" class="ml-2 w-10"
                        onclick="librariesDelete()">
                    <img src="{{ asset('assets/img/icon_edit.svg') }}" class="ml-2 w-10" onclick="editModal()">
                    <img src="{{ asset('assets/img/icon_play.svg') }}" class="ml-2 w-10">
                </div>
                <div id="response-massage"></div>
            </div>
        </div>
        {{-- <a target="blank" href="{{ route('test-library', '3') }}">Test</a> --}}
    </section>

    <script src="{{ asset('assets/js/lobby_btn.js') }}"></script>
    <script src="{{ asset('assets/js/lobby_fetch.js') }}"></script>
</body>

</html>
