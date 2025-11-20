<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white border-b border-neutral-200 shadow-sm sticky top-0 z-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl tracking-tight text-emerald-600 hover:text-emerald-700 transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>EduTrack{{ auth()->check() && auth()->user()->isAdmin() ? ' Admin' : '' }}</span>
                </a>
            </div>

            
            <div class="hidden md:flex items-center gap-8">
                <div class="flex items-center gap-6 text-sm font-medium">
                    @guest
                        <a href="{{ route('home') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Beranda
                        </a>
                        <a href="{{ route('courses.catalog') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Kursus
                        </a>
                        <a href="{{ route('about') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tentang
                        </a>
                        <a href="#" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Support
                        </a>
                    @else
                        @if(auth()->user()->isStudent())
                            <a href="{{ route('home') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Beranda
                            </a>
                            <a href="{{ route('courses.catalog') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Kursus
                            </a>
                            <a href="{{ route('student.dashboard') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Belajar Saya
                            </a>
                        @elseif(auth()->user()->isTeacher())
                            <a href="{{ route('teacher.dashboard') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Dashboard Pengajar
                            </a>
                            <a href="{{ route('teacher.courses.index') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Kursus Saya
                            </a>
                        @elseif(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                User
                            </a>
                            <a href="{{ route('admin.courses.index') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Kursus
                            </a>
                            <a href="{{ route('categories.index') }}" class="text-neutral-700 hover:text-emerald-600 transition flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Kategori
                            </a>
                        @endif
                    @endguest
                </div>

                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm text-neutral-700 px-4 py-2 hover:text-emerald-600 transition font-medium">
                            Login
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="text-sm inline-flex items-center justify-center px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm transition font-medium"
                        >
                            Register
                        </a>
                    @else
                        
                        <button class="relative p-2 text-neutral-600 hover:text-emerald-600 transition rounded-lg hover:bg-neutral-100">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                        </button>

                        
                        <div class="relative" x-data="{ open: false }">
                            <button
                                type="button"
                                @click="open = !open"
                                class="flex items-center gap-2 rounded-full border-2 border-neutral-200 hover:border-emerald-500 transition p-1 focus:outline-none"
                            >
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </button>

                            <div
                                x-cloak
                                x-show="open"
                                @click.away="open = false"
                                x-transition
                                class="absolute right-0 mt-2 w-48 rounded-lg border border-neutral-200 bg-white py-1 shadow-lg z-50"
                            >
                                <div class="px-4 py-2 border-b border-neutral-100">
                                    <p class="text-sm font-semibold text-neutral-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-neutral-500">{{ Auth::user()->email }}</p>
                                </div>
                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-50 transition"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition"
                                    >
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>

            
            <div class="flex md:hidden items-center gap-2">
                @auth
                    <button class="relative p-2 text-neutral-600 hover:text-emerald-600 transition rounded-lg">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                @endauth
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

    
    <div x-cloak x-show="open" class="md:hidden border-t border-neutral-200 bg-white">
        <div class="px-4 pt-3 pb-4 space-y-3">
            <div class="space-y-2 text-sm">
                @guest
                    <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Beranda
                    </a>
                    <a href="{{ route('courses.catalog') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Kursus
                    </a>
                    <a href="{{ route('about') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Tentang
                    </a>
                @else
                    @if(auth()->user()->isStudent())
                        <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Beranda</a>
                        <a href="{{ route('courses.catalog') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Kursus</a>
                        <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Belajar Saya</a>
                    @elseif(auth()->user()->isTeacher())
                        <a href="{{ route('teacher.dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Dashboard Pengajar</a>
                        <a href="{{ route('teacher.courses.index') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Kursus Saya</a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">User</a>
                        <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Kursus</a>
                        <a href="{{ route('categories.index') }}" class="flex items-center gap-2 px-3 py-2 text-neutral-700 hover:bg-neutral-50 rounded-lg">Kategori</a>
                    @endif
                @endguest
            </div>

            <div class="border-t border-neutral-200 pt-3 space-y-2">
                @guest
                    <a
                        href="{{ route('login') }}"
                        class="block w-full text-center text-sm text-neutral-700 px-3 py-2 rounded-lg hover:bg-neutral-100 font-medium"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="block w-full text-center text-sm px-3 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 font-medium"
                    >
                        Register
                    </a>
                @else
                    <div class="px-3 py-2 text-sm text-neutral-700">
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <a
                        href="{{ route('profile.edit') }}"
                        class="block text-sm text-neutral-700 px-3 py-2 rounded-lg hover:bg-neutral-100"
                    >
                        Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="block w-full text-left text-sm text-red-600 px-3 py-2 rounded-lg hover:bg-red-50"
                        >
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
