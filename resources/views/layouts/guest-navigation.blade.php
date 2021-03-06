<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('admin.login') }}">
                        <x-yukiniwa-logo  class="block w-auto h-12 text-gray-600 fill-current"/>
                    </a>
                    <h1 class="text-xl antialiased tracking-tighter text-blue-400">
                        -YUKINIWA-
                    </h1>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('user.guest')" :active="request()->routeIs('user.guest')">
                        {{ __('ホーム') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="36">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center font-medium text-gray-500 transition duration-150 ease-in-out text-md hover:text-green-600 hover:border-gray-300">
                            <div>{{ __('Login') }}</div>

                            <div class="ml-1">
                                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <div class="flex flex-col w-full ">
                            <a href="{{ route('user.login') }}" class="mb-2 text-gray-500 transition duration-150 ease-in-out text-md hover:text-green-400 hover:bg-gray-200" >
                                <p class="ml-2">Login</p>
                            </a>
                            @if (Route::has('user.register'))
                            <a href="{{ route('user.register') }}" class="text-gray-500 transition duration-150 ease-in-out text-md hover:text-green-400 hover:bg-gray-200">
                                <p class="ml-2">Register</p>
                            </a>
                            @endif
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.guest')" :active="request()->routeIs('user.guest')">
                {{ __('ホーム') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.login')" :active="request()->routeIs('user.login')">
                {{ __('ログイン') }}
            </x-responsive-nav-link>
        </div>
        @if (Route::has('user.register'))
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.register')" :active="request()->routeIs('user.register')">
                {{ __('ユーザー登録') }}
            </x-responsive-nav-link>
        </div>
        @endif
    </div>
</nav>