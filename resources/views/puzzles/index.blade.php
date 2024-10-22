<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Puzzels</h1>
        <div class="grid grid-cols-2 gap-4">
            @foreach($puzzles as $puzzle)
                <div>
                    <a href="{{ route('puzzles.show', $puzzle) }}"
                       class="block bg-blue-600 text-white text-xl text-center py-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Puzzle name: {{$puzzle->title}}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
