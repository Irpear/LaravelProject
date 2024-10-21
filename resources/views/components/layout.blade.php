<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>les4</title>

    @vite('resources/css/app.css')
</head>
<body>

<div class="min-h-full">
    @if (Route::has('login'))
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            @auth
                                <x-Navlink href="/" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" :active="request()->is('/')">Home</x-Navlink>
                                <x-Navlink href="/puzzles" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" :active="request()->is('puzzles')" >Puzzles</x-Navlink>
                                <x-Navlink href="/dashboard" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" :active="request()->is('dashboard')" >Dashboard</x-Navlink>
                                <x-Navlink href="/create" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" :active="request()->is('create')" >Create</x-Navlink>
                            @else
                                <x-Navlink href="/login" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" :active="request()->is('login')" >Login</x-Navlink>
                                <x-Navlink href="/register" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" :active="request()->is('register')" >Register</x-Navlink>
                            @endauth

                        </div>
                    </div>
                </div>





                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>


            </div>
        </div>
    </nav>
    @endif
    <main>

        {{ $slot }}

    </main>
</div>







{{--@if (Route::has('login'))--}}
{{--    <nav class="navbar">--}}
{{--        @auth--}}
{{--            <x-Navlink href="/" :active="request()->is('/')">home</x-Navlink>--}}
{{--            <x-Navlink href="/puzzles" :active="request()->is('puzzles')" >puzzles</x-Navlink>--}}
{{--            <x-Navlink href="/dashboard" :active="request()->is('dashboard')" >dashboard</x-Navlink>--}}
{{--            <x-Navlink href="/create" :active="request()->is('create')" >create</x-Navlink>--}}
{{--        @else--}}
{{--            <x-Navlink href="/login" :active="request()->is('login')" >login</x-Navlink>--}}
{{--            <x-Navlink href="/register" :active="request()->is('register')" >register</x-Navlink>--}}

{{--        @endauth--}}
{{--    </nav>--}}
{{--@endif--}}



{{--<main>--}}
{{--    {{ $slot }}--}}
{{--</main>--}}

{{--<a href="{{ url(route('home')) }}">Terug naar home</a>--}}

{{--@if ($is_admin)--}}
{{--    wdawdadw--}}
{{--@else ()--}}
{{--    dwadwadw--}}
{{--@endif ()--}}

</body>
</html>
