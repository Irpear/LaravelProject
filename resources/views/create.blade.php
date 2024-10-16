<x-layout>

    <form action="{{ url(route('puzzles.store')) }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div>
            <label for="solution">Solution:</label>
            <textarea name="solution" id="solution" required></textarea>
        </div>

        <div>
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="Logica">Logica</option>
                <option value="Wiskunde">Wiskunde</option>
                <option value="Raadsel">Raadsel</option>
            </select>
        </div>

        <button type="submit">Add Puzzle</button>
    </form>
</x-layout>
