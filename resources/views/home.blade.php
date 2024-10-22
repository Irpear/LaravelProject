<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Welkom op deze website voor raadsels, puzzels en andere denkproblemen.</h1>
        @auth
        @else
            <p>Log in om je eigen puzzels toe te voegen.</p>
        @endauth
    </div>
</x-layout>
