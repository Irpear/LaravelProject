<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->role === 'admin')
                        <h3 class="text-2xl font-bold mb-4">Alle Puzzels</h3>
                    @else
                        <h3 class="text-2xl font-bold mb-4">Mijn Puzzels</h3>
                    @endif

                    @if ($puzzles->isEmpty())
                        <p>Je hebt nog geen puzzels toegevoegd.</p>
                    @else
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($puzzles as $puzzle)
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('puzzles.show', $puzzle) }}"
                                       class="block bg-blue-600 text-white text-xl text-center py-4 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 w-full">
                                        Puzzle name: {{ $puzzle->title }}
                                    </a>

                                    @if (auth()->user()->role === 'admin')
                                        <!-- Toggle status button for Admins -->
                                        <form action="{{ route('puzzles.toggleStatus', $puzzle) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="bg-{{ $puzzle->status }}-500 text-white font-bold py-2 px-4 rounded">
                                                {{ $puzzle->status ? 'Aan' : 'Uit' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
