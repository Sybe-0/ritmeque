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
    <section class="bg-custom-pink basis-1/4 h-screen">
        <div class="flex items-center p-2 mt-1.5">
            <img src="{{ asset('assets/img/icon_not.svg') }}" class="mr-2">
            <h1 class="font-semibold text-2xl">Your Library</h1>
        </div>
        <div class="bg-white w-full h-0.5 mb-1"></div>
        <div class="flex items-center p-2">
            <button onclick="popModal()" class="flex items-center p-2 rounded-[8px] text-xl w-full bg-pink-900">
                <img src="{{ asset('assets/img/icon_plus_only.svg') }}" class="mr-2">New Library
            </button>
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

    {{-- !modal add library! --}}
    <section class="w-screen h-screen fixed justify-center items-center hidden" id="library-modal">
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
    {{-- !modal edit library! --}}
    <section class="w-screen h-screen fixed justify-center items-center hidden" id="library-edit-modal">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-4/12">
            <div class="flex justify-between items-center">
                <p class="text-2xl">Edit Your Library :</p>
                <button onclick="closeModal()" class="bg-red-400 border-[1px] px-2 rounded-[4px]">X</button>
            </div>
            <form action="/home/edit/library" method="post" class="mt-4">
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
    <section class="w-screen h-screen fixed justify-center items-center hidden" id="url-modal">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-4/12">
            <div class="flex justify-between items-center">
                <p class="text-2xl">Insert URL :</p>
                <button onclick="closeModal()" class="bg-red-400 border-[1px] px-2 rounded-[4px]">X</button>
            </div>
            <form action="/home/playlist" method="post" class="mt-4">
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
    <section class="w-screen h-screen fixed justify-center items-center hidden" id="modal-url-update">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-4/12">
            <div class="flex justify-between items-center">
                <p class="text-2xl">Edit Playlist :</p>
                <button onclick="closeModal()" class="bg-red-400 border-[1px] px-2 rounded-[4px]">X</button>
            </div>
            <form action="/home/edit/playlist" method="post" class="mt-4">
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
    <section class="w-screen h-screen fixed justify-center items-center hidden" id="library-del">
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
    <section class="w-screen h-screen fixed justify-center items-center hidden" id="playlist-del">
        <div class="bg-[#1e1e1e] p-4 border-[1px] rounded-[12px] w-2/12">
            <form action="/playlist/delete" method="post">
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
    <section class="basis-3/4">
        <div class="flex justify-between items-center mt-4 mx-2">
            <h1 class="text-2xl font-bold p-2">All Libraries</h1>
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
        <div class="flex overflow-x-auto mt-4">
            @foreach ($datalibrary as $library)
                <div class="p-2 ml-4 bg-[#1e1e1e] w-36 h-42 flex flex-col border-[1px] rounded-[8px]"
                    onclick="playList({{ $library->id }})">
                    <div class="w-30 h-20 bg-white m-auto rounded-[4px]"></div>
                    <div class="">{{ $library->platform }}</div>
                    <div class="">{{ $library->title }}</div>
                </div>
            @endforeach
        </div>
        {{-- playlist --}}
        <div class="mt-4 flex">
            <div class="basis-3/4 px-4">
                <h2 class="text-2xl">Playlist</h2>
                {{--  --}}
                <ul class="" id="test"></ul>
            </div>
            <div class="basis-1/4 min-h-80 h-full border-[1px] px-6" id="show-border">
                <div class="text-2xl" id="library-title"></div>
                <div class="" id="library-description"></div>
                <div class="hidden items-center" id="url-btn">
                    <img src="{{ asset('assets/img/icon_plus_add.svg') }}" class="w-12" onclick="urlInput()">
                    <img src="{{ asset('assets/img/icon_trash.svg') }}" class="ml-2 w-10"
                        onclick="librariesDelete()">
                    <img src="{{ asset('assets/img/icon_edit.svg') }}" class="ml-2 w-10" onclick="editModal()">
                    <img src="{{ asset('assets/img/icon_play.svg') }}" class="ml-2 w-10">
                </div>
            </div>
        </div>
        {{-- <a target="blank" href="{{ route('test-library', '3') }}">Test</a> --}}
    </section>

    <script>
        const modalLibrary = document.querySelector('#library-modal');
        const modalEdit = document.querySelector('#library-edit-modal');
        const modalUrl = document.querySelector('#url-modal');
        const modalUpdateUrl = document.querySelector('#modal-url-update');
        const btnUrl = document.querySelector('#url-btn');
        const libraryDel = document.querySelector('#library-del');
        const playlistDel = document.querySelector('#playlist-del');
        //area const for any on play desk.
        const libraryTitle = document.querySelector('#library-title');
        const libraryDesc = document.querySelector('#library-description');
        const playlistTest = document.querySelector('#test');

        let deleteId;

        function librariesDelete() {
            if (libraryDel.style.display === "none") {
                libraryDel.style.display = "flex";
            } else {
                libraryDel.style.display = "none";
            }
        }

        function modalDelPlay(id) {
            document.querySelector('#playlist-del input[name="playlist_id"]').value = (id);

            // example for tenary condition
            playlistDel.style.display = !playlistDel.style.display ? 'flex' : (playlistDel.style.display === 'none' ? 'flex' : 'none')

            // if (!playlistDel.style.display) {
            //     playlistDel.style.display = "flex";
            // } else {
            //     if (playlistDel.style.display === "none") {
            //         playlistDel.style.display = "flex";
            //     } else {
            //         playlistDel.style.display = "none";
            //     }
            // }
        }

        function modalUpdatePlay(id) {
            fetch('/playlist/find?id=' + id)
                .then(response => response.json())
                .then(alpha => {
                    console.log(alpha);

                    document.querySelector('#modal-url-update input[name="playlist_id"]').value = (id);
                    document.querySelector('#modal-url-update input[name="songs"]').value = alpha.songs;
                    document.querySelector('#modal-url-update input[name="url_link"]').value = alpha.url_link;
                });
            if (modalUpdateUrl.style.display === "none") {
                modalUpdateUrl.style.display = "flex";
            } else {
                modalUpdateUrl.style.display = "none";
            }
        }

        function urlInput() {
            if (modalUrl.style.display === "none") {
                modalUrl.style.display = "flex";
            } else {
                modalUrl.style.display = "none";
            }
        }

        function popModal() {
            if (modalLibrary.style.display === "none") {
                modalLibrary.style.display = "flex";
            } else {
                modalLibrary.style.display = "none";
            }
        }

        function editModal() {
            if (modalEdit.style.display === "none") {
                modalEdit.style.display = "flex";
            } else {
                modalEdit.style.display = "none";
            }
        }

        function playList(id) {
            fetch('/library/find?id=' + id)
                .then(response => response.json())
                .then(data => {
                    btnUrl.style.display = "flex";
                    libraryTitle.textContent = data.title;
                    libraryDesc.textContent = data.description;
                    document.querySelector('#url-modal input[name="libraries_id"]').value = (id);
                    document.querySelector('#library-del input[name="libraries_id"]').value = (id);
                    document.querySelector('#library-edit-modal input[name="libraries_id"]').value = (id);
                    document.querySelector('#library-edit-modal input[name="title"]').value = data.title;
                    document.querySelector('#library-edit-modal input[name="description"]').value = data.description;
                });

            fetch('/library/playlist/find?id=' + id)
                .then(response => response.json())
                .then(list => {
                    playlistTest.innerHTML = '';
                    list.forEach(play => {
                        let list =
                            `<div class="flex justify-between items-center w-full border-b-[1px] mt-2">
                                <div class="flex">
                                    <img class="mr-10" src="{{ asset('assets/img/icon_menu_stripes.svg') }}">
                                    <div class="text-xl">${play.songs}</div>
                                </div>
                                <div class="flex">
                                    <button class="mr-2 px-2" onclick="modalUpdatePlay(${play.id})">Edit</button>
                                    <button class="ml-2 px-2 bg-custom-pink rounded-[4px]" onclick="modalDelPlay(${play.id})">Hapus</button>
                                </div>
                            </div>`
                        playlistTest.insertAdjacentHTML("beforeend", list);
                    });
                });
            }

        function closeModal() {
            modalLibrary.style.display = "none";
            modalEdit.style.display = "none";
            modalUrl.style.display = "none";
            modalUpdateUrl.style.display = "none";
            libraryDel.style.display = "none";
            playlistDel.style.display = "none";
        }

        function submitModal() {
            closeModal();
        }
    </script>
</body>

</html>
