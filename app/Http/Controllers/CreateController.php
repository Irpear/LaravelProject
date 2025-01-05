<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CreateController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('create', compact('categories'));
    }
}
