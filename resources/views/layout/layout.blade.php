<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    @vite('resources/css/app.css')
</head>
<body class="font-Onest text-white bg-[#1b1b1b] overflow-hidden p-3 flex justify-center items-center h-screen">

    <div class="h-screen w-full flex items-center gap-5">

        {{-- Sidebar --}}
        <nav class="h-[95%] w-82 bg-[#111] flex flex-col text-white rounded-3xl border-[#555] p-5">
            <h1 class="font-semibold text-2xl text-center py-6 mb-7">Inventaris.</h1>
            <ul>

                {{-- Dashboard --}}
                {{-- <li>
                    <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('operator.dashboard') }}" 
                        class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                        {{ request()->is('*/dashboard') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                        Dashboard
                    </a>
                </li> --}}


                {{-- Categories --}}
                @if (Auth::user()->role == 'admin')    
                    <li>
                        <a href="{{ route('admin.categories.index') }}" 
                            class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                            {{ request()->is('*/categories*') || request()->is('*/create-categories') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-column-stacked-icon lucide-chart-column-stacked"><path d="M11 13H7"/><path d="M19 9h-4"/><path d="M3 3v16a2 2 0 0 0 2 2h16"/><rect x="15" y="5" width="4" height="12" rx="1"/><rect x="7" y="8" width="4" height="9" rx="1"/></svg>
                            Categories
                        </a>
                    </li>
                @endif


                {{-- Items --}}
                @if (Auth::user()->role == 'admin')    
                    <li>
                        <a href="{{ route('admin.items.index') }}" 
                            class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                            {{ request()->is('*/items*') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-database-icon lucide-database"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/></svg>
                            Items
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('staff.items') }}" 
                            class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                            {{ request()->is('*/items*') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-database-icon lucide-database"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/></svg>
                            Items
                        </a>
                    </li>
                @endif
                

                {{-- Lending --}}
                @if (Auth::user()->role == 'staff') 
                    <li>
                        <a href="{{ route('staff.lending.index') }}" 
                            class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                            {{ request()->is('*/lending*') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-database-icon lucide-database"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/></svg>
                            Lending
                        </a>
                    </li>
                @endif


                {{-- Users --}}
                @if (Auth::user()->role == 'admin')     
                    <li>
                        <a href="{{ route('admin.users.admin') }}" 
                                class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                                {{ request()->is('*/users/admin*') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round"><path d="M18 21a8 8 0 0 0-16 0"/><circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
                                Users - Admin
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.staff') }}" 
                            class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                            {{ request()->is('*/users/staff*') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round"><path d="M18 21a8 8 0 0 0-16 0"/><circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
                            Users - Staff
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('staff.users.edit', Auth::user()->id) }}" 
                            class="h-full w-full flex mb-2 bg-[#f5f5f5] rounded-lg text-black px-3 py-2 cursor-pointer justify-start items-center gap-x-2 text-sm
                            {{ request()->is('*/users*') ? 'bg-[#f5f5f5] text-black border-transparent' : 'bg-transparent text-white border border-[#555] hover:bg-[#222]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round"><path d="M18 21a8 8 0 0 0-16 0"/><circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg>
                            Users - Edit
                        </a>
                    </li>
                @endif

            </ul>

            <a href="{{ route('logout') }}" 
                class="border border-[#555] rounded-lg text-white mt-10 px-3 py-2 w-full cursor-pointer flex justify-start gap-x-2 text-sm hover:bg-[#f5f5f5] hover:text-[#111] duration-300 transition-all">
                <x-icons.logout />
                Logout
            </a>

        </nav>



        {{-- Main --}}
        <div class="h-[95%] w-full rounded-3xl flex flex-col gap-y-3">
            
            <header class="h-26 bg-[#111] py-5 pl-7 pr-4 flex items-center justify-between rounded-2xl">

                <h1 class="text-lg">Selamat datang, {{ Auth::user()->name }}</h1>

                <div class="flex justify-center items-center gap-x-6 bg-[#222] py-4 px-5 rounded-2xl">
                    <img src="{{ Auth::user()->role == 'admin' ? asset('images/profile-admin.jpg') : asset('images/profile-operator.jpg') }}" width="50" class="rounded-full" alt="profile">
                    <div class="flex flex-col">
                        <p>{{ Auth::user()->name }}</p>
                        <p class="text-sm text-white/80">{{ Auth::user()->email }}</p>
                    </div>

                </div>
            </header>

            <div class="p-10 bg-[#111] h-full rounded-2xl w-full overflow-y-auto overflow-x-hidden no-scrollbar" style="scrollbar-width: none; -ms-overflow-style: none;">
                @yield('content')
            </div>

        </div>
    </div>
    
    @stack('scripts')
</body>
</html>