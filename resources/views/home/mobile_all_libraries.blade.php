<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
</head>

<body class="bg-custom-darkblue">
    <section
        class="fixed top-0 left-0 bg-custom-pink px-2 pt-6 h-screen w-[60%] translate-x-[-100%] transition-transform ease-in-out duration-500"
        id="sidebar">
        <ul>
            <li><input type="search" name="" id="" placeholder="Search Library"></li>
            <li><a href="/home">All Libraries</a></li>
            <li><a href="/home/favorite">Favorite</a></li>
            <li><a href="home/recently">Recently</a></li>
        </ul>
    </section>

    <header class="fixed  ml-2 p-2 flex items-center">
        <div class="mr-2 text-xl" id="sidebar-btn">≡</div>
        <h2 class="text-xl">All Libraries</h2>
    </header>

    <script src="{{ asset('assets/js/lobby_btn.js') }}"></script>
</body>

</html>
