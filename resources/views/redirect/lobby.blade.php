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

    <section class="basis-3/4">
        <div class="flex justify-between items mt-4 mx-2">
            <h1 class="text-2xl font-bold p-2">All Libraries</h1>
            @auth
                <form action="/home/logout" method="post">
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
    </section>
    <section class="w-screen h-screen fixed justify-center items-center hidden" id="modalLibrary">
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
                <button type="submit" onclick="submitModal()" class="bg-custom-pink p-2 w-full mt-4 rounded-[10px]">Add Library</button>
            </form>
        </div>
    </section>

    <script>
        const modalLibrary = document.querySelector('#modalLibrary');
        const inputLibrary = document.querySelector('#inputUrl');

        function popModal() {
            if (modalLibrary.style.display === "none") {
                modalLibrary.style.display = "flex";
            } else {
                modalLibrary.style.display = "none";
            }
        }

        function closeModal() {
            modalLibrary.style.display = "none";
        }

        function submitModal() {
            closeModal();
        }

        function pasteText() {
            navigator.clipboard.readText()
                .then(text => {
                    inputLibrary.value = text;
                });
        }
    </script>
</body>

</html>
