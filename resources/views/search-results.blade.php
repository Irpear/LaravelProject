<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Puzzels</h1>

        <form action="{{ route('search') }}" method="GET" class="space-y-4">
            <div>
                <input type="text" name="query" placeholder="Zoek..." value="{{ request('query') }}" class="border p-2 rounded w-full">
            </div>

            <div>
                <select name="category_id" class="border p-2 rounded w-full">
                    <option value="">Alle categorieën</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Zoeken</button>
                <a href="{{ route('puzzles.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Filters verwijderen</a>
            </div>
        </form>

        @if(isset($results) && $results->isNotEmpty())
            <p class="mt-4">Resultaten voor: "{{ $query }}" in categorie: {{ request('category_id') ? $categories->find(request('category_id'))->name : 'Alle categorieën' }}</p>
            <div class="grid grid-cols-2 gap-4 mt-4">
                @foreach($results as $result)
                    <div>
                        <a href="{{ route('puzzles.show', $result) }}" class="block bg-blue-600 text-white text-xl text-center py-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            {{ $result->title }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="mt-4">Geen resultaten gevonden.</p>
        @endif
    </div>
</x-layout>
