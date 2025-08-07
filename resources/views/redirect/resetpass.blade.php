@vite('resources/css/app.css')
<section class="bg-custom-darkblue h-screen flex justify-center items-center">
    <div class="bg-custom-pink p-4 rounded-2xl">
        <form method="post" action="{{ route('password.email') }}" class="m-2">
            @csrf
            <div class="">
                <label for="email" class="text-2xl">Please input Your email!</label>
                <input type="email" name="email" class="mt-4 w-full text-xl focus:outline-none border-b-2 rounded-[10px] p-1.5" placeholder="Username" required>
            </div>
            <button type="submit" class="mt-8 w-full border-2 text-2xl font-semibold h-11 rounded-[10px]">Submit</button>
            <button class="mt-2 w-full border-2 text-2xl font-semibold h-11 rounded-[10px] bg-custom-darkblue" onclick="history.back()">Back</button>
        </form>
    </div>
</section>