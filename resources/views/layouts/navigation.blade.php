<nav x-data="{ open: false }" class="bg-gray-600 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">
            <div class="flex mt-2 text-indigo-300">
                {{ date('Y-m-d H:i:s') }}
            </div>
            <div class="flex mt-2 text-xl text-gray-300">
                Administrative menu
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="flex justify-center">
                    <div>
                        <div class="dropdown relative">
                            <a class="dropdown-toggle px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded  focus:outline-none focus:ring-0 active:shadow-lg active:text-white transition duration-150 ease-in-out flex  items-center  whitespace-nop" href="#" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->username }}
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down"
                                    class="w-2 ml-2" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z">
                                    </path>
                                </svg>
                            </a>
                            <ul class="dropdown-menu min-w-max absolute bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg  mt-1 hidden m-0 bg-clip-padding border-none" aria-labelledby="dropdownMenuButton2">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item cursor-pointer text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent  text-gray-700  hover:bg-gray-10 " onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
