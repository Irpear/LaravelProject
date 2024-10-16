<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;

class PuzzleController extends Controller
{
    public function index()
    {
        $puzzles = Puzzle::all();

        return view('puzzles.index', compact('puzzles'));
    }
}
