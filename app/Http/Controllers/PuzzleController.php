<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

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

        $puzzle = new Puzzle();
        $puzzle->title = $request->input('title');
        $puzzle->description = $request->input('description');
        $puzzle->solution = $request->input('solution');
        $puzzle->category = $request->input('category');
        $puzzle->status = 0;
        $puzzle->user_id = auth()->id();
        $puzzle->save();
        return redirect(route('puzzles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Puzzle $puzzle)
    {
        return view('puzzles.show' , compact('puzzle'));
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

}

