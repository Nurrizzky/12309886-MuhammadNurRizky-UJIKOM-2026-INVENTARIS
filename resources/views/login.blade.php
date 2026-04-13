<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="font-Onest bg-[#111] text-white">

    <div class="h-screen w-full bg-[#111] overflow-hidden flex justify-between relative">

        <a href="{{ route('landing') }}">
            <svg class="absolute top-5 left-5 cursor-pointer hover:text-white/70 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-left-icon lucide-circle-arrow-left"><circle cx="12" cy="12" r="10"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg>
        </a>

        <div class="w-full h-screen flex justify-center items-center">

            <form action="{{ route('login') }}" method="POST" class="w-96 flex items-center">
                @csrf


                @if (Session::get('failed'))
                    <div class="alert alert-danger"> {{ Session::get('failed') }} </div>
                @endif
                @if (Session::get('success'))
                    <div class="alert alert-danger"> {{ Session::get('success') }} </div>
                @endif


                <div class="w-full flex flex-col gap-y-2 items-start ">
                    <img src="{{ asset('images/wikrama-logo.png') }}" width="50 " alt="">
                    <h1 class="text-left mt-2 mb-5 text-lg">Login to your Inventory Account</h1>

                    <x-ui.input name="email" type="email" placeholder="Email Address..." />
                    @error('email')
                        <x-ui.message>{{ $message }}</x-ui.message>
                    @enderror

                    <x-ui.input name="password" type="password" placeholder="Password.." />
                    @error('password')
                        <x-ui.message>{{ $message }}</x-ui.message>
                    @enderror

                    <x-ui.button-login type="submit">
                        Login
                    </x-ui.button-login>

                </div>
            </form>

        </div>
        <img src="{{ asset('images/flow-2.jpg') }}" alt="" class="mask-luminance mask-t-from-white mask-t-from-70% mask-t-to-black -mr-150 bg-center">
    </div>
    
</body>
</html>