<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    @vite('resources/css/app.css')
</head>
<body class="font-Onest">
    
    <div class="h-screen w-full bg-[#111] text-white flex flex-col justify-center items-center">
        <p class="text-xs text-white/80 tracking-wider">
            Page Not Found.
        </p>
        <h1 class="text-9xl font-semibold tracking-wide text-shadow-lg text-shadow-gray-300 mt-10">404</h1>
        <p class="text-white/80 text-lg tracking-wider font-semibold mt-10 text-center">
            Oops!
             <span class="text-sm text-white/80 tracking-wider font-normal">We Couldn't find the page you're looking for...</span>
        </p>
        <button 
            class="border-none bg-[#f5f5f5] rounded-lg text-black mt-10 px-5 py-2 w-fit cursor-pointer flex justify-center items-center gap-x-4 text-sm"
            onclick="window.history.back()"
        >
            <x-icons.arrow-left />
            Back to current page
        </button>

    </div>

</body>
</html>