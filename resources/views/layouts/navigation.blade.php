<nav class="bg-white shadow-lg" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">
                        Sistem Presensi
                    </a>
                </div>

                @auth
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <div class="flex space-x-1">
                            <a href="{{ route('presence.index') }}"
                                class="relative px-3 py-2 sm:rounded-md text-sm font-medium transition-colors duration-200
                                    {{ request()->routeIs('presence.index')
                                        ? 'text-indigo-700 bg-indigo-50'
                                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Presensi</span>
                                </div>
                                @if (request()->routeIs('presence.index'))
                                    <span class="absolute bottom-0 left-0 h-0.5 w-full bg-indigo-500"></span>
                                @endif
                            </a>

                            <a href="{{ route('presence.recap') }}"
                                class="relative px-3 py-2 sm:rounded-md text-sm font-medium transition-colors duration-200
                                    {{ request()->routeIs('presence.recap')
                                        ? 'text-indigo-700 bg-indigo-50'
                                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Rekap</span>
                                </div>
                                @if (request()->routeIs('presence.recap'))
                                    <span class="absolute bottom-0 left-0 h-0.5 w-full bg-indigo-500"></span>
                                @endif
                            </a>

                            <a href="{{ route('leaves.index') }}"
                                class="relative px-3 py-2 sm:rounded-md text-sm font-medium transition-colors duration-200
                                    {{ request()->routeIs('leaves.index')
                                        ? 'text-indigo-700 bg-indigo-50'
                                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Pengajuan Izin</span>
                                </div>
                                @if (request()->routeIs('leaves.index'))
                                    <span class="absolute bottom-0 left-0 h-0.5 w-full bg-indigo-500"></span>
                                @endif
                            </a>

                            @if (auth()->user()->is_admin)
                                <a href="{{ route('leaves.approvals') }}"
                                    class="relative px-3 py-2 sm:rounded-md text-sm font-medium transition-colors duration-200
                                    {{ request()->routeIs('leaves.approvals')
                                        ? 'text-indigo-700 bg-indigo-50'
                                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                    <div class="flex items-center space-x-2">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Persetujuan Izin</span>
                                    </div>
                                    @if (request()->routeIs('leaves.approvals'))
                                        <span class="absolute bottom-0 left-0 h-0.5 w-full bg-indigo-500"></span>
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                @endauth
            </div>

            <div class="flex items-center">
                @guest
                    <a href="{{ route('login') }}"
                        class="bg-indigo-600 text-white hover:bg-indigo-700 px-3 py-2 sm:rounded-md text-sm font-medium">
                        Masuk
                    </a>
                @else
                    <!-- Mobile menu button -->
                    <div class="sm:hidden -mr-2 flex items-center">
                        <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="inline-flex items-center justify-center p-2 sm:rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="h-6 w-6" x-show="mobileMenuOpen" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- User dropdown section -->
                    <div class="ml-3 relative hidden inset-x-0 sm:block z-50" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-3 py-2 px-3 sm:rounded-lg hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center">
                                <span class="text-white font-medium text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95" @click.away="open = false"
                            class="absolute right-0 mt-2 w-64 sm:rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">

                            <!-- User Info Section -->
                            <div class="px-4 py-3">
                                <p class="text-sm text-gray-900 font-medium truncate">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ Auth::user()->employee_id }}</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <a href="{{ route('profile.index') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>
                            </div>

                            <!-- Logout Section -->
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors duration-200">
                                        <svg class="mr-3 h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>

        <!-- Mobile menu -->
        @auth
            <div class="sm:hidden fixed inset-x-0 top-16 z-50" x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                @click.away="mobileMenuOpen = false">
                <div class="bg-white shadow-lg border-b border-gray-200 max-h-[calc(100vh-4rem)] overflow-y-auto">
                    <div class="max-w-7xl mx-auto">
                        <!-- User Info Section -->
                        <div class="px-4 py-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center">
                                        <span class="text-white font-medium text-sm">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->employee_id }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="px-2 py-3 space-y-1">
                            <a href="{{ route('profile.index') }}"
                                class="{{ request()->routeIs('profile.index') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-l-4 hover:border-gray-300' }} 
                                    block px-3 py-3 text-base font-medium transition-all duration-200">
                                <div class="flex items-center">
                                    <svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </div>
                            </a>

                            <a href="{{ route('presence.index') }}"
                                class="{{ request()->routeIs('presence.index') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-l-4 hover:border-gray-300' }} 
                    block px-3 py-3 text-base font-medium transition-all duration-200">
                                <div class="flex items-center">
                                    <svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Presensi
                                </div>
                            </a>

                            <a href="{{ route('presence.recap') }}"
                                class="{{ request()->routeIs('presence.recap') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-l-4 hover:border-gray-300' }} 
                    block px-3 py-3 text-base font-medium transition-all duration-200">
                                <div class="flex items-center">
                                    <svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Rekap
                                </div>
                            </a>

                            <a href="{{ route('leaves.index') }}"
                                class="{{ request()->routeIs('leaves.index') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-l-4 hover:border-gray-300' }} 
                    block px-3 py-3 text-base font-medium transition-all duration-200">
                                <div class="flex items-center">
                                    <svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Pengajuan Izin
                                </div>
                            </a>

                            @if (auth()->user()->is_admin)
                                <a href="{{ route('leaves.approvals') }}"
                                    class="{{ request()->routeIs('leaves.approvals') ? 'bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-l-4 hover:border-gray-300' }} 
                        block px-3 py-3 text-base font-medium transition-all duration-200">
                                    <div class="flex items-center">
                                        <svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Persetujuan Izin
                                    </div>
                                </a>
                            @endif
                        </div>

                        <!-- Logout Button -->
                        <div class="px-2 py-3 border-t border-gray-200">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-3 py-3 text-base font-medium text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="mr-4 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</nav>
