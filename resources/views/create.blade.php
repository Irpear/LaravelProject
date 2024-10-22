<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Voeg een puzzel toe</h1>

        <form action="{{ url(route('puzzles.store')) }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-lg font-semibold mb-1">Titel:</label>
                <input type="text" name="title" id="title" required
                       class="border border-gray-300 p-2 rounded w-full text-lg">
            </div>

            <div>
                <label for="description" class="block text-lg font-semibold mb-1">Beschrijving:</label>
                <textarea name="description" id="description" required
                          class="border border-gray-300 p-2 rounded w-full text-lg" rows="4"></textarea>
            </div>

            <div>
                <label for="solution" class="block text-lg font-semibold mb-1">Oplossing:</label>
                <textarea name="solution" id="solution" required
                          class="border border-gray-300 p-2 rounded w-full text-lg" rows="4"></textarea>
            </div>

            <div>
                <label for="category" class="block text-lg font-semibold mb-1">Categorie:</label>
                <select name="category" id="category" required
                        class="border border-gray-300 p-2 rounded w-full text-lg">
                    <option value="Logica">Logica</option>
                    <option value="Wiskunde">Wiskunde</option>
                    <option value="Raadsel">Raadsel</option>
                </select>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors duration-200">
                Voeg Puzzel Toe
            </button>
        </form>
    </div>
</x-layout>
