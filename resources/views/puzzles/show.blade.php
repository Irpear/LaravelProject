<x-layout>

    <div class="p-6">
        <button onclick="window.history.back()" class="bg-blue-600 text-white font-bold py-2 px-4 rounded">
            {{ __('Terug naar de puzzels') }}
        </button>
    </div>

    <div class="text-xl pl-8 pr-8 pt-4">
        {{$puzzle->title}}
    </div>

    <div class="text-lg pl-8 pr-8 pb-4 pt-4">
        {{$puzzle->description}}
    </div>

    <div x-data="{ showSolution: false }" class="p-6">
        <button @click="showSolution = !showSolution" class="bg-gray-800 text-white font-bold py-2 px-4 rounded">
            {{ __('Toon oplossing') }}
        </button>

        <div x-show="showSolution" class="mt-4 text-green-500 text-lg">
            {{ $puzzle->solution }}
        </div>
    </div>

    @if ($puzzle->user_id === auth()->id() || auth()->user()->role === 'admin')
        <div class="p-6">
            <a href="{{ route('puzzles.edit', $puzzle) }}" class="bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                {{ __('Bewerk puzzel') }}
            </a>
        </div>
    @endif

</x-layout>
