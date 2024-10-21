

<x-layout>
    @foreach($puzzles as $puzzle)

        <li>
            <a href="{{ route('puzzles.show', $puzzle) }}">
                puzzle name: {{$puzzle ->title}}
            </a>

        </li>
    @endforeach

</x-layout>
