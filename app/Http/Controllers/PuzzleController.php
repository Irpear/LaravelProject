<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;


class PuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $puzzles = Puzzle::where('status', 1)->get();

        return view('puzzles.index', compact('puzzles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
            'category' => 'required|in:Logica,Wiskunde,Raadsel',
        ]);


        $user = Auth::user();
        $aantalPuzzels = Puzzle::where('user_id', $user->id)
            ->where('status', 1)
            ->count();

        $puzzle = new Puzzle();
        $puzzle->title = $request->input('title');
        $puzzle->description = $request->input('description');
        $puzzle->solution = $request->input('solution');
        $puzzle->category = $request->input('category');
        if ($aantalPuzzels >= 3){
            $puzzle->status = 1;
        } else {
            $puzzle->status = 0;
        }
        $puzzle->user_id = auth()->id();
        $puzzle->save();
        return redirect(route('puzzles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Puzzle $puzzle)
    {
        return view('puzzles.show', compact('puzzle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $puzzle = Puzzle::findOrFail($id);

        return view('puzzles.edit', compact('puzzle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puzzle $puzzle)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
            'category' => 'required|string',
        ]);

        $puzzle->update($request->only(['title', 'description', 'solution', 'category']));


        return redirect()->route('dashboard', $puzzle);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Puzzle $puzzle)
    {

        $puzzle->status = !$puzzle->status;
        $puzzle->save();

        return redirect()->route('dashboard')->with('status', 'Puzzelstatus bijgewerkt.');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        $results = Puzzle::query()
            ->where('status', 1)
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
            ->when($category, function ($queryBuilder) use ($category) {
                return $queryBuilder->where('category', $category);
            })
            ->get();

        return view('search-results', compact('results', 'query', 'category'));
    }


}



