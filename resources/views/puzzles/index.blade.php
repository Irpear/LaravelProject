<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Puzzels</h1>

        <form action="{{ route('search') }}" method="GET" class="space-y-4">
            <div>
                <input type="text" name="query" placeholder="Zoek..." value="{{ old('query', request('query')) }}" class="border p-2 rounded w-full">
            </div>

            <div>
                <select name="category" class="border p-2 rounded w-full">
                    <option value="">Alle categorieën</option>
                    <option value="Logica" {{ request('category') == 'Logica' ? 'selected' : '' }}>Logica</option>
                    <option value="Wiskunde" {{ request('category') == 'Wiskunde' ? 'selected' : '' }}>Wiskunde</option>
                    <option value="Raadsel" {{ request('category') == 'Raadsel' ? 'selected' : '' }}>Raadsel</option>
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 mb-4 py-2 rounded hover:bg-blue-700">Zoeken</button>
                <a href="{{ route('puzzles.index') }}" class="bg-gray-500 mb-4 text-white px-4 py-2 rounded hover:bg-gray-600">Filters verwijderen</a>
            </div>
        </form>
        <div class="grid grid-cols-2 gap-4">
            @foreach($puzzles as $puzzle)
                <div>
                    <a href="{{ route('puzzles.show', $puzzle) }}"
                       class="block bg-blue-600 text-white text-xl text-center py-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        {{$puzzle->title}}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
