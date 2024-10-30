<?php

namespace App\Http\Controllers;
use App\Models\Puzzle;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $puzzles = Puzzle::all();
        } else {
            $puzzles = Puzzle::where('user_id', auth()->id())->get();
        }

        return view('dashboard', compact('puzzles'));
    }
}
