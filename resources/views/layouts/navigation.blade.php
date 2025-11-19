<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur border-b border-neutral-200">
    <div class="mx-auto max-w-7xl px-4 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="font-bold text-2xl tracking-tight text-neutral-900">
                    EduTrack
                </a>
            </div>

            <!-- Desktop navigation -->
            <div class="hidden md:flex items-center gap-8">
                <div class="flex items-center gap-6 text-sm">
                    <a href="{{ route('courses.catalog') }}" class="text-neutral-700 hover:text-neutral-900">
                        Kursus
                    </a>
                    <a href="{{ route('courses.catalog') }}" class="text-neutral-700 hover:text-neutral-900">
                        Kategori
                    </a>
                    <a href="{{ route('about') }}" class="text-neutral-700 hover:text-neutral-900">
                        Tentang
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm text-neutral-700 px-3 py-2 hover:text-neutral-900">
                            Login
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="text-sm inline-flex items-center justify-center px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition"
                        >
                            Register
                        </a>
                    @else
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-sm text-neutral-700 hover:text-neutral-900 px-3 py-2"
                        >
                            Dashboard
                        </a>

                        <div class="relative">
                            <button
                                type="button"
                                @click="open = !open"
                                class="inline-flex items-center gap-2 rounded-md border border-neutral-200 bg-white px-3 py-2 text-sm text-neutral-700 hover:text-neutral-900 hover:border-neutral-300 focus:outline-none"
                            >
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div
                                x-cloak
                                x-show="open"
                                @click.away="open = false"
                                class="absolute right-0 mt-2 w-44 rounded-md border border-neutral-200 bg-white py-1 shadow-lg z-40"
                            >
                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="block px-3 py-2 text-sm text-neutral-700 hover:bg-neutral-50"
                                >
                                    Profil
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50"
                                    >
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Mobile hamburger -->
            <div class="flex md:hidden items-center">
                <button
                    @click="open = !open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-neutral-700 hover:bg-neutral-100 focus:outline-none"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path
                            :class="{ 'hidden': open, 'inline-flex': !open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                        <path
                            :class="{ 'hidden': !open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-cloak x-show="open" class="md:hidden border-t border-neutral-200 bg-white">
        <div class="px-4 pt-3 pb-4 space-y-3">
            <div class="space-y-2 text-sm">
                <a href="{{ route('courses.catalog') }}" class="block text-neutral-700 hover:text-neutral-900">
                    Kursus
                </a>
                <a href="{{ route('courses.catalog') }}" class="block text-neutral-700 hover:text-neutral-900">
                    Kategori
                </a>
                <a href="{{ route('about') }}" class="block text-neutral-700 hover:text-neutral-900">
                    Tentang
                </a>
            </div>

            <div class="border-t border-neutral-200 pt-3 space-y-2">
                @guest
                    <a
                        href="{{ route('login') }}"
                        class="block w-full text-center text-sm text-neutral-700 px-3 py-2 rounded-md hover:bg-neutral-100"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="block w-full text-center text-sm px-3 py-2 rounded-md bg-emerald-600 text-white hover:bg-emerald-700"
                    >
                        Register
                    </a>
                @else
                    <div class="text-sm text-neutral-700">
                        Masuk sebagai <span class="font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <a
                        href="{{ route('dashboard') }}"
                        class="block text-sm text-neutral-700 px-3 py-2 rounded-md hover:bg-neutral-100"
                    >
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="block w-full text-left text-sm text-red-600 px-3 py-2 rounded-md hover:bg-red-50"
                        >
                            Log out
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
