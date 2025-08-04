<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RitmeQue Sign In</title>
    @vite('resources/css/app.css')
</head>

<body>
    <main class="flex bg-main bg-cover text-xl">
        <section class="basis-2/4 mb-8 ml-8 flex flex-col justify-end">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="font-bold text-4xl">Build Your playlist from any</h2>
            <p class="font-light text-3xl">Sources.</p>
        </section>

        <section class="basis-2/4 flex flex-col justify-center px-20 h-lvh">
            <img src="{{ asset('assets/img/logo_ritmeque_white.png') }}" class="w-72 self-center mb-2.5 mt-10">
            <h2 class="-mt-8 text-center text-4xl font-semibold cursor-default">Sign In</h2>
            <p class="text-center text-2xl mb-10 cursor-default">Enter Your account and Welcome back!</p>

            <form action="/signin" method="post" class="flex flex-col items-center">
                @csrf
                <input type="text" name="email" placeholder="Email" class="media-main-input mb-2.5" required>
                <input type="password" name="password" placeholder="Password" class="media-main-input" required>
                <div class="mt-2 mb-3 w-full flex justify-between">
                    <div class="mx-4 flex items-center">
                        <input type="checkbox" name="checklist"
                            class="appearance-none bg-pink-700 w-4 h-4 rounded-xs mr-2.5 checked:appearance-auto mt-1 cursor-pointer">
                        <p class="text-xl cursor-default">Remember me</p>
                    </div>
                    <p class="mx-4 text-custom-pink text-xl cursor-pointer">Forgot password?</p>
                </div>
                <button type="submit" class="w-full bg-custom-pink text-2xl font-semibold h-11 rounded-[10px]"
                    onclick="">Submit</button>
                <p class="text-xl my-2.5 cursor-default">Don't have any account? <span
                        class="ml-1 hover:text-pink-700 hover:text-lg cursor-pointer text-pink-800"><a
                            href="/signup">Sign Up</a></span>
                </p>
            </form>

            <div class="w-full mt-10 flex flex-col self-end">
                <p class="text-xl mb-2.5 self-center cursor-default">Or just one click</p>
                <button class="btn-social-media mb-3">
                    <img src="{{ asset('assets/img/google_icon.svg') }}" class="w-6 ">
                    <p class="text-custom-pink self-center ml-2 font-medium">Google</p>
                </button>
                <button class="btn-social-media">
                    <img src="{{ asset('assets/img/facebook_icon.svg') }}" class="w-6 ">
                    <p class="text-custom-pink self-center ml-2 font-medium">Facebook</p>
                </button>
            </div>
        </section>
    </main>
</body>

</html>
