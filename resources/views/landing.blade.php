<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris</title>
    @vite('resources/css/app.css')
</head>
<body class="font-Onest bg-[#111] ">


    <main class="h-screen w-full flex justify-between items-center bg-[#111]" >
        <div class="flex flex-col text-left ml-15">

            <img src="{{ asset('images/wikrama-logo.png') }}" class="absolute top-5 left-14" width="70" alt="">

            <h1 class="font-semibold text-5xl tracking-wide mt-5 text-white">
                Inventory Management <br>of SMK Wikrama 
            </h1>
            <p class="my-3 text-white/80">management of incoming and outgoing <br>itemns at SMK Wikrama Bogor.</p>


            <div class="flex gap-2">
                <x-ui.button-icon href="{{ route('showLogin') }}">
                    Login
                    <x-icons.arrow-up-right />
                </x-ui.button-icon>
                 <a href="#flow" class="group px-5 py-2 w-fit mt-2 border border-[#f5f5f5] rounded-md text-white hover:bg-white/20 flex justify-between transition-all duration-200">
                    see feature 
                </a>
            </div>
        </div>
        <img src="{{ asset('images/heropage.jpg') }}" alt="landing" width="800" class="mr-15 rounded-2xl">
    </main>


    <main class="h-fit w-full flex flex-col items-center text-white bg-[#111]" id="flow">
        <div class="flex flex-col items-center mt-10">
            <h1 class="font-semibold text-3xl">
                Our System Flow of SMK Wikrama 
            </h1>
            <p class="text-white/80 mt-2">Our inventory system workflow</p>
        </div>
        <div class="w-full flex mt-50 justify-evenly items-center ">
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/flow-1.jpg') }}" alt="flow-1" class="rounded-2xl" width="200">
                <p class="text-sm tracking-wide font-semibold mt-4">Items Data</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/flow-2.jpg') }}" alt="flow-1" class="rounded-2xl" width="300">
                <p class="text-sm tracking-wide font-semibold mt-4">Management Tecnician</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/flow-3.jpg') }}" alt="flow-1" class="rounded-2xl" width="210">
                <p class="text-sm tracking-wide font-semibold mt-4">Management Lending</p>
            </div>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/heropage.jpg') }}" alt="flow-1" class="rounded-2xl mt-2" width="400">
                <p class="text-sm tracking-wide font-semibold mt-5">All can borrow</p>
            </div>
        </div>
    </main>


    <footer class="h-72 w-full bg-[#333] text-white mt-50 flex px-20 justify-between items-start pt-10 ">
        <div class="flex flex-col">
            <img src="{{ asset('images/wikrama-logo.png') }}" width="60" alt="">
            <p class="mt-5">smkwikrama@sch.id</p>
            <p>001-7876-2876</p>
        </div>
        <div class="flex gap-x-30">
            <div class="flex flex-col">
                <h3 class="font-semibold">Our Guidelines</h3>
                <p class="text-sm text-white/80 mt-2">Terms</p>
                <p class="text-sm text-white/80">Privacy policy</p>
                <p class="text-sm text-white/80">Cookie policy</p>
                <p class="text-sm text-white/80">Discover</p>
            </div>
            <div class="flex flex-col">
                <h3 class="font-semibold">Our Address</h3>
                <p class="text-sm text-white/80 mt-2">Jalan Wangun Tengah <br>Sindangsari <br>Jawa Barat</p>
            </div>
        </div>
    </footer>
</body>
</html>