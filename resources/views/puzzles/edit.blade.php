<x-layout>
    @auth
        @if (auth()->user()->id !== $puzzle->user_id && auth()->user()->role !== 'admin')
            <script>
                window.location.href = "{{ route('home') }}";
            </script>
        @endif
    @else
        <script>
            window.location.href = "{{ route('login') }}"; // of een andere redirect naar de inlogpagina
        </script>
    @endauth
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Pas een puzzel aan</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('puzzles.update', $puzzle->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-lg font-semibold mb-1">Titel:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $puzzle->title) }}" required
                       class="border border-gray-300 p-2 rounded w-full text-lg">
            </div>

            <div>
                <label for="description" class="block text-lg font-semibold mb-1">Beschrijving:</label>
                <textarea name="description" id="description" required
                          class="border border-gray-300 p-2 rounded w-full text-lg" rows="4">{{ old('description', $puzzle->description) }}</textarea>
            </div>

            <div>
                <label for="solution" class="block text-lg font-semibold mb-1">Oplossing:</label>
                <textarea name="solution" id="solution" required
                          class="border border-gray-300 p-2 rounded w-full text-lg" rows="4">{{ old('solution', $puzzle->solution) }}</textarea>
            </div>

            <div>
                <label for="category" class="block text-lg font-semibold mb-1">Categorie:</label>
                <select name="category" id="category" required
                        class="border border-gray-300 p-2 rounded w-full text-lg">
                    <option value="Logica" {{ $puzzle->category == 'Logica' ? 'selected' : '' }}>Logica</option>
                    <option value="Wiskunde" {{ $puzzle->category == 'Wiskunde' ? 'selected' : '' }}>Wiskunde</option>
                    <option value="Raadsel" {{ $puzzle->category == 'Raadsel' ? 'selected' : '' }}>Raadsel</option>
                </select>
            </div>

            <button type="submit"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors duration-200">
                Pas puzzel aan
            </button>
        </form>
    </div>
</x-layout>
