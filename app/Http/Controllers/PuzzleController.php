<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use App\Models\User;
use App\Models\Category;
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
        $categories = Category::all();
        $puzzles = Puzzle::where('status', 1)->get();

        return view('puzzles.index', compact('puzzles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Voer een titel in.',
            'description.required' => 'Voer een beschrijving in.',
            'solution.required' => 'Voer een oplossing in.',
            'category_id.required' => 'Selecteer één van de drie categorieën.',
        ]);


        $user = Auth::user();
        $aantalPuzzels = Puzzle::where('user_id', $user->id)
            ->where('status', 1)
            ->count();

        $puzzle = new Puzzle();
        $puzzle->title = $request->input('title');
        $puzzle->description = $request->input('description');
        $puzzle->solution = $request->input('solution');
        $puzzle->category_id = $request->input('category_id');
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
        $categories = Category::all();
        $user = auth()->user();

        if (!$user || ($user->role !== 'admin' && $puzzle->user_id !== $user->id)) {
            abort(403, 'Je hebt geen toegang tot deze puzzel.');
        }

        return view('puzzles.edit', compact('puzzle', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puzzle $puzzle)
    {

        if (auth()->user()->role !== 'admin' && $puzzle->user_id !== auth()->id()) {
            abort(403, 'Je hebt geen toegang tot deze puzzel.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $puzzle->update($request->only(['title', 'description', 'solution', 'category_id']));


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

        if (auth()->user()->role !== 'admin' && $puzzle->user_id !== auth()->id()) {
            abort(403, 'Je hebt geen toegang tot deze puzzel.');
        }

        $puzzle->status = !$puzzle->status;
        $puzzle->save();

        return redirect()->route('dashboard')->with('status', 'Puzzelstatus bijgewerkt.');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category_id');
        $categories = Category::all();

        $results = Puzzle::query()
            ->where('status', 1)
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
            ->when($category, function ($queryBuilder) use ($category) {
                return $queryBuilder->where('category_id', $category);
            })
            ->get();

        return view('search-results', compact('results', 'query', 'category', 'categories'));
    }



}



