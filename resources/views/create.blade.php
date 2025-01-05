<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Voeg een puzzel toe</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url(route('puzzles.store')) }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-lg font-semibold mb-1">Titel:</label>
                <input type="text" name="title" id="title"
                       class="border border-gray-300 p-2 rounded w-full text-lg" value="{{ old('title') }}">
            </div>

            <div>
                <label for="description" class="block text-lg font-semibold mb-1">Beschrijving:</label>
                <textarea name="description" id="description"
                          class="border border-gray-300 p-2 rounded w-full text-lg" rows="4">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="solution" class="block text-lg font-semibold mb-1">Oplossing:</label>
                <textarea name="solution" id="solution"
                          class="border border-gray-300 p-2 rounded w-full text-lg" rows="4">{{ old('solution') }}</textarea>
            </div>

            <div>
                <label for="category_id" class="block text-lg font-semibold mb-1">Categorie:</label>
                <select name="category_id" id="category_id" class="border border-gray-300 p-2 rounded w-full text-lg">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors duration-200">
                Voeg Puzzel Toe
            </button>
        </form>
    </div>
</x-layout>
