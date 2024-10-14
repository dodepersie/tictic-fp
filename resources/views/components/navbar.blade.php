<header class="fixed bg-white w-full shadow z-10">

    <!-- Top menu -->
    <div class="hidden md:block bg-gray-900">
        <div class="mx-auto max-w-screen-2xl p-3 text-white">
            <div class="flex justify-end items-center">
                <div class="relative md:flex md:items-center md:gap-4" x-data="{ showDropdown: false }">
                    <!-- For LG screens -->
                    <nav aria-label="Global" class="hidden md:block">
                        <ul class="flex items-center text-sm">
                            <li>
                                <a class="font-bold hover:bg-white hover:text-black p-3 {{ Request::is('about') ? 'bg-white text-black' : '' }}"
                                    href="{{ route('about') }}">
                                    About
                                </a>
                            </li>

                            <li>
                                <a class="font-bold hover:bg-white hover:text-black p-3 {{ Request::is('event*') ? 'bg-white text-black' : '' }}"
                                    href="{{ route('event.index') }}">
                                    Tickets
                                </a>
                            </li>

                            <li>
                                <a class="font-bold hover:bg-white hover:text-black p-3 {{ Request::is('categories*') ? 'bg-white text-black' : '' }}"
                                    href="{{ route('categories') }}">
                                    Categories
                                </a>
                            </li>

                            @guest
                                <li>
                                    <a class="font-bold hover:bg-white hover:text-black p-3"
                                        href="{{ route('register_merchant') }}">
                                        Become TicTic
                                        Partner </a>
                                </li>
                            @endguest
                        </ul>
                    </nav>

                    <!-- For small screens -->
                    <div class="absolute end-0 z-10 mt-2 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg"
                        role="menu" x-cloak x-transition x-show="showDropdown" x-on:click.away="showDropdown = false"
                        x-on:keydown.escape.window="showDropdown = false">
                        <div class="p-2">
                            <a href="{{ route('about') }}"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                role="menuitem">
                                About
                            </a>

                            <a href="{{ route('event.index') }}"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                role="menuitem">
                                Ticket
                            </a>

                            @guest
                                <a href="{{ route('register') }}"
                                    class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                    role="menuitem">
                                    Register Account
                                </a>

                                <a href="{{ route('register_merchant') }}"
                                    class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                    role="menuitem">
                                    Become TicTic Partner
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom menu -->
    <nav class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-1 sm:gap-20">
            <!-- TicTic Logo -->
            <div class="md:flex md:items-center md:w-1/6">
                <a class="block text-black text-2xl font-bold" href="{{ route('home') }}">
                    <div class="flex items-center">
                        <img src="{{ asset('/assets/img/TicTic Logo.png') }}" class="h-14 w-16" alt="TicTic Logo" />
                        <div class="hidden sm:block">
                            <span class="sr-only">Home</span>
                            TicTic
                        </div>
                    </div>
                </a>
            </div>

            <!-- Seach Bar -->
            <div class="justify-center md:flex md:w-full md:items-center">
                <form action="{{ route('event.index') }}" class="w-full">
                    <div>
                        <label for="search" class="sr-only">Search</label>
                        @if (request('merchant'))
                            <input type="hidden" name="merchant" value="{{ request('merchant') }}" />
                        @endif
                        @if (request('location'))
                            <input type="hidden" name="location" value="{{ request('location') }}" />
                        @endif
                        <div class="relative">
                            <input type="text" name="search"
                                class="w-full h-10 rounded-lg border-gray-200 px-4 pr-12 text-sm"
                                placeholder="Search fun activity.." value="{{ request('search') }}"
                                autocomplete="off" />

                            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                                <svg class="size-4 text-gray-400" fill="none" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                </svg>
                                </svg>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Menu -->
            <div class="relative md:flex md:justify-end md:items-center md:w-1/6" x-data="{ showDropdown: false }">
                <div class="flex justifty-center items-center gap-2">
                    <div class="hidden md:flex md:gap-3">
                        @guest
                            <div x-data="{ isActive: false }" class="relative">
                                <div class="inline-flex items-center overflow-hidden rounded-md bg-transparent">
                                    <button x-on:click="isActive = !isActive" class="h-full" x-transition>
                                        <span class="sr-only">User Logo</span>
                                        <img src="{{ asset('/assets/img/noprofile.webp') }}" alt="Profile icon"
                                            class="w-10 h-10 rounded-full" />
                                    </button>
                                </div>

                                <div class="absolute end-0 z-10 mt-2 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg"
                                    role="menu" x-cloak x-transition x-show="isActive" x-on:click.away="isActive = false"
                                    x-on:keydown.escape.window="isActive = false">
                                    <div class="p-2">
                                        <a href="{{ route('login') }}"
                                            class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem">
                                            Login
                                        </a>

                                        <a href="{{ route('register') }}"
                                            class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem">
                                            Register an account
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endguest

                        @auth
                            <div class="flex items-center gap-2">
                                <div x-data="{ isActive: false }" class="relative">
                                    <div
                                        class="inline-flex items-center overflow-hidden rounded-md bg-transparent gap-1.5">
                                        <div x-on:click="isActive = !isActive"
                                            class="hidden lg:block text-sm cursor-pointer">{{ auth()->user()->name }}
                                        </div>
                                        <button x-on:click="isActive = !isActive" class="h-full" x-transition>
                                            <span class="sr-only">User Logo</span>
                                            <img src="{{ auth()->user()->profile_picture ? asset('/storage/user_profile/' . auth()->user()->profile_picture) : asset('/assets/img/noprofile.webp') }}"
                                                alt="{{ auth()->user()->name }}" class="w-10 h-10 border rounded-full" />
                                        </button>
                                    </div>

                                    <div class="absolute end-0 z-10 mt-2 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg"
                                        role="menu" x-cloak x-transition x-show="isActive"
                                        x-on:click.away="isActive = false" x-on:keydown.escape.window="isActive = false">
                                        <div class="p-2">
                                            <a href="{{ route('dashboard.index') }}"
                                                class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                                role="menuitem">
                                                Dashboard
                                            </a>

                                            <a href="{{ route('profile.index') }}"
                                                class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                                role="menuitem">
                                                Edit Profile
                                            </a>
                                        </div>

                                        <div class="p-2">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
                                                    role="menuitem">
                                                    <svg class="w-4 h-4" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                                                    </svg>
                                                    Log Out
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <div class="block md:hidden">
                        <button class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75"
                            @click="showDropdown = !showDropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- For small screens -->
                <div class="absolute end-0 z-10 mt-2 w-56 rounded-md border border-gray-100 bg-white shadow-lg"
                    role="menu" x-cloak x-transition x-show="showDropdown" x-on:click.away="showDropdown = false"
                    x-on:keydown.escape.window="showDropdown = false">
                    <div class="divide-y divide-gray-200">
                        <div class="p-2">
                            <a href="{{ route('about') }}"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                role="menuitem">
                                About
                            </a>

                            <a href="{{ route('event.index') }}"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                role="menuitem">
                                Ticket
                            </a>

                            <a href="{{ route('categories') }}"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                role="menuitem">
                                Categories
                            </a>
                        </div>

                        @guest
                            <div class="p-2">
                                <a href="{{ route('login') }}"
                                    class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                    role="menuitem">
                                    Login
                                </a>

                                <a href="{{ route('register') }}"
                                    class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                    role="menuitem">
                                    Register Account
                                </a>

                                <a href="{{ route('register_merchant') }}"
                                    class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                    role="menuitem">
                                    Become TicTic Partner
                                </a>
                            </div>
                        @endguest

                        @auth
                            <div class="divide-y divide-gray-200">
                                <div class="p-2">
                                    <a href="{{ route('dashboard.index') }}"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                        role="menuitem">
                                        Dashboard
                                    </a>

                                    <a href="{{ route('profile.index') }}"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                        role="menuitem">
                                        Edit Profile
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-2 rounded-lg p-2 text-sm text-red-700 hover:bg-red-50"
                                            role="menuitem">
                                            <svg class="w-3.5 h-3.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                                            </svg>
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
