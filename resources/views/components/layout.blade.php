<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>les4</title>

    @vite('resources/css/app.css')
</head>
<body>


@if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <x-Navlink href="/" :active="request()->is('/')">home</x-Navlink>
            <x-Navlink href="/puzzles" :active="request()->is('puzzles')" >puzzles</x-Navlink>
            <x-Navlink href="/dashboard" :active="request()->is('dashboard')" >dashboard</x-Navlink>
            <x-Navlink href="/create" :active="request()->is('create')" >create</x-Navlink>
        @else
            <x-Navlink href="/login" :active="request()->is('login')" >login</x-Navlink>
            <x-Navlink href="/register" :active="request()->is('register')" >register</x-Navlink>

        @endauth
    </nav>
@endif



<main>
    {{ $slot }}
</main>

{{--<a href="{{ url(route('home')) }}">Terug naar home</a>--}}

{{--@if ($is_admin)--}}
{{--    wdawdadw--}}
{{--@else ()--}}
{{--    dwadwadw--}}
{{--@endif ()--}}

</body>
</html>
